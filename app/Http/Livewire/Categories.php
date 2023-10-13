<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Livewire\Component;
use App\Models\Category;
use App\Traits\CategoryTrait;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use function Laravel\Prompts\search;
use Illuminate\Validation\Rules\Unique;

class Categories extends Component
{
    use WithPagination;
    use WithFileUploads;

    //propiedades o variables

    public Category $category;
    public $upload, $savedImg, $editing, $search, $records;

    protected $paginationTheme = 'bootstrap';

    //reglas de validacion del campo name del modulo categoria

    protected $rules = [
        'category.name' => "required|min:2|max:55|unique:catogories,name",
    ];


    // funcion para no actualizarse en cada itereacion o request para disminuir carga del servidor

    public function mount()
    {
        $this->category = new Category();
        $this->editing = false;
    }

    //eventos

    protected $listeners = [
        'search' => 'searching',
        'destroy'
    ];

    public function searching($searchText)
    {
        $this->search = $searchText;
    }




    public function render()
    {
        return view(
            'livewire.categories',
            [
                'categories' => $this->loadCategories()
            ]

        );
    }

    //funcion para hacer la busqueda en el campo buscar

    public function loadCategories()
    {
        if (!empty($this->search)) {
            $this->resetPage();
            $query = Category::where('name', 'like', "%{$this->search}%")
                ->orderBy('name', 'asc');
        } else {
            $query = Category::orderBy('name', 'asc');
        }

        $this->records = $query->count();
        return $query->paginate(5);
    }

    //metodo para crear Registro 
    public function Add()
    {
        $this->resetValidation();
        $this->resetExcept('category');
        $this->category = new Category();
    }

    //metodo para editar

    public function Edit(Category $category)
    {
        $this->resetValidation();
        $this->category = $category;
        $this->upload = null;
        $this->savedImg = $category->picture;
        $this->editing = true;
    }

    //metodo para cancela edicion de categoria

    public function cancelEdit()
    {
        $this->resetValidation();
        $this->category = new Category();
        $this->editing = false;
    }

    //metodo de guardar informacion en la base de datos

    public function Store()
    {
        sleep(2);

        //validacion antes de Guardar
        $this->rules['category.name'] = $this->category->id > 0 ? "required|min:2|max:50|unique:categories,name, {$this->category->id}" : 'required|min:2|max:55|unique:categories,name';
        $this->validate($this->rules);

        // Formatear el nombre de la categoría para tener la primera letra en mayúscula y el resto en minúscula
        $formattedName = ucfirst(strtolower($this->category->name));

        // Asignar el nombre formateado a la categoría
        $this->category->name = $formattedName;

        //metodo de edicion de imagen
        $tempImg = null;
        if ($this->category->id > 0) {
            $tempImg = $this->category->image;
        }
        //guardar edicion de la categoria
        $this->category->save();

        //validacion de imagen

        if (!empty($this->upload)) {
            //$tempImg = $this->category->image->file;
            //validar si el archivo existe fisicamente
            if ($tempImg != null && file_exists('storage/categories/' . $tempImg)) {
                //eliminar fisicamente el archivo
                unlink('storage/categories/' . $tempImg->file);
            }
            //eliminar la relacion previa de la base de datos el modulo de categoria con el modulo de image
            $this->category->image()->delete();
            // defenir nombre temporal para guardar el archivo
            $fileName = uniqid() . '_.' . $this->upload->extension();
            //Guardar imagen fisicamente
            $this->upload->storeAs('public/categories', $fileName);
            //crear registro en la tabla image
            $img = Image::create([
                'model_id' => $this->category->id,
                'model_type' => 'App\Models\category',
                'file' => $fileName
            ]);
            //recrear la recion con la tabla image con categoria
            $this->category->Image()->save($img);
        }

        $this->dispatchBrowserEvent('noty', ['msg' => 'OPERACION CON EXITO']);
        $this->dispatchBrowserEvent('stop-loader');
        $this->resetExcept('category');
        $this->category = new Category();
    }

    //funcion para eliminar una categoria
    public function destroy(Category $category)
    {
        //$category = Category::find($id);
        // 1. Elimina una imagen asociada a la categoría si existe y el archivo físico existe
        $tempImg = $category->image;
        if ($tempImg != null && file_exists('storage/categories/' . $tempImg->file)) {
            unlink('storage/categories/' . $tempImg->file);
        }
        // 2. Elimina la relación de la imagen con la categoría en la base de datos
        $category->image()->delete();
        // 3. Si la categoría tiene un platform_id definido, llama a la función 'deleteCategory' para realizar una acción relacionada.
        if ($category->platform_id != null) {
            $this->deleteCategory($category->platform_id);
        }
        // 4. Elimina la categoría
        $category->delete();
        // 5. Resetea la página (posiblemente para refrescar la vista)
        $this->resetPage();
        // 6. Emite un evento del navegador llamado 'noty' con un mensaje de éxito
        $this->dispatchBrowserEvent('noty', ['msg' => 'OPERACION EXITOSA']);
        // 7. Emite un evento del navegador llamado 'stop-loader' ( para detener algún tipo de proceso de carga)
        $this->dispatchBrowserEvent('stop-loader');
    }

    public function Sync(Category $category)
    {
        $this->findOrCreateCategoryByName($category);
    }
}

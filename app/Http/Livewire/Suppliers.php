<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class Suppliers extends Component
{


    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //propiedades
    public $search, $editing, $records;
    public Supplier $supplier;

    //reglas del campo nombre

    protected $rules = [
        'supplier.name' => "required|min:2|max:55|unique:suppliers,name",
    ];


    public function mount()
    {
        $this->supplier = new Supplier();
        $this->editing = false;
    }



    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'destroy'
    ];


    public function searching($searchText)
    {

        $this->search = trim($searchText);
    }



    public function render()
    {
        return view(
            'livewire.suppliers',
            ['suppliers' => $this->loadSuppliers()]

        );
    }

    //metodo para cargar  los recursos
    function loadSuppliers()
    {


        if (!empty($this->search)) {
            $this->resetPage();
            $query = Supplier::where('name', 'like', "%{$this->search}%")
                ->orderBy('name', 'asc')->paginate(2);
        } else {
            $query = Supplier::orderBy('name', 'asc')->paginate(2);
        }

        $this->records = $query->count();
        return $query;
    }

    //agregar nuevo supplier

    public function Add()
    {
        $this->resetValidation();
        $this->resetExcept('supplier');
        $this->supplier = new Supplier();
    }

    public function Edit(Supplier $supplier)
    {
        $this->resetValidation();
        $this->supplier = $supplier;
        $this->editing = true;
    }

    //metodo para cancela edicion de Proveedor

    public function cancelEdit()
    {
        $this->resetValidation();
        $this->supplier = new Supplier();
        $this->editing = false;
    }

    public function Store()
    {
        sleep(1);


        $this->rules['supplier.name'] = $this->supplier->id > 0 ? "required|min:2|max:50|unique:suppliers,name, {$this->supplier->id}" : 'required|min:2|max:55|unique:suppliers,name';
        $this->validate($this->rules);


        $formattedName = ucfirst(strtolower($this->supplier->name));
        $this->supplier->name = $formattedName;
        $this->supplier->save();

        $this->dispatchBrowserEvent('noty', ['msg' => 'OPERACION CON EXITO']);
        $this->dispatchBrowserEvent('stop-loader');
        $this->resetExcept('supplier');
        $this->supplier = new Supplier();
    }

    public function destroy(Supplier $supplier)
    {

        
        $supplier->delete();
      
        $this->resetPage();
       
        $this->dispatchBrowserEvent('noty', ['msg' => 'OPERACION EXITOSA']);
        
        $this->dispatchBrowserEvent('stop-loader');
    }
}

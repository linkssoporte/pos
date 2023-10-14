<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait CategoryTrait
{

    use WoocommerceTrait;
    //metodo para traer las categorias de la tienda
    public function getCategories()
    {

        $woocommerce = $this->getConnection();
        //retorna coleccion de categorias
        return $woocommerce->get('products/categories');
    }


    //crear Categorias
    public function createCategory($name)
    {
        try {
            $woocommerce = $this->getConnection();
            $data = ['name' => $name];
            $result = $woocommerce->post('products/categories', $data);
            Log::info(json_encode($result));

            return $result->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateCategory($category)
    {

        try {
            $woocommerce = $this->getConnection();
            $data = [
                'name' => $category->name
            ];

            $result = $woocommerce->put("products/categories/{$category->platform_id}", $data);
            return $result->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //sincronizar categorias  local y en linea o viceversa
    public function findOrCreateCategoryByName($category)
    {
        try {
            $woocommerce = $this->getConnection();
            $params = [
                'search' => $category->name
            ];

            $result = $woocommerce->get('products/categories', $params);

            Log::info(json_encode($result));

            if (!empty($result)) {
                $category->platfomr_id = $result[0]->id;
                $category->save();
            } else {
                $result = $this->createCategory($category->name);
                $category->platform_id = $result;
                $category->save();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteCategory($id)
    {
        $woocommerce = $this->getConnection();

        return $woocommerce->delete("products/categories/{$id}", ['force' => true]);
    }
}

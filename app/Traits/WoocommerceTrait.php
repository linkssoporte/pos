<?php

namespace App\Traits;

use App\Models\Integration;
use Automattic\WooCommerce\Client;

trait WoocommerceTrait{
    //metodo para generar la conexion 
    public function getConnection()
    {
        try {
            $platform = Integration::first();
            if($platform !=null && $platform->count()>0){

                //instancia a la Api
                $woocommerce = new Client(
                    $platform->url,
                    $platform->key,
                    $platform->secret,
                    [
                        'version'=> 'wc/v3',
                    ]);
                    //retornamos conexion
                    return $woocommerce;
                    
                    
                    
                
            }else{
                throw('No hay credenciales e integracion a woocommerce');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        

        
    }

    public function deleteCategory($id){
        $woocommerce = $this->getConnection();
        return $woocommerce->delete("products/categories/{$id}", ['force'=>true]);


    }
}
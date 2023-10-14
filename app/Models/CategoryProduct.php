<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// El modelo "CategoryProduct" se utiliza para representar la relación entre categorías y productos en la base de datos.
class CategoryProduct extends Model
{
    // Importa el trait HasFactory para la creación de registros más sencilla.
    use HasFactory;
    // Define los campos que se pueden llenar de forma masiva. Esto permite establecer estos campos al crear registros.
    protected $fillable = ['category_id', 'product_id'];
    // Especifica el nombre de la tabla de la base de datos asociada con este modelo.
    protected $table ='category_products';
}

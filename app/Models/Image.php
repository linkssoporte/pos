<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   //actualiza las imagenes de la base de datos de forma masiva
    use HasFactory;
    protected $fillable =[
        'model_id',
        'model_type',
        'file',
    ];

    //relacion polimorfica  con varios modelos o componetes de manera generica
    public function image()
    {
        return $this->MorphTo();
    }
}

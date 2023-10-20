<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'sku',
        'name',
        'description',
        'type',
        'status',
        'visibility',
        'price',
        'price2',
        'stock_status',
        'manage_stock',
        'stock_qty',
        'low_stock',
        'supplier_id',
        'platform_id'
    ];

    function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }



    public function latestImage()
    {
        //recent image
        return $this->morphOne(Image::class, 'model')->latestOfMany();
    }

    //accesor de imagen reciente

    public function getPhotoAttribute()
    {
        if (count($this->images)) {
            return  "storage/products/" . $this->images->last()->file;
        } else {
            return 'storage/no-image.jpg';
        }
    }
}

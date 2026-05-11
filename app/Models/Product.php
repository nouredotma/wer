<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'price', 
        'stock', 
        'main_image', 
        'thumbnail_images', 
        'sizes_available', 
        'colors_available'
    ];

    protected $casts = [
        'thumbnail_images' => 'array',
        'sizes_available' => 'array',
        'colors_available' => 'array',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

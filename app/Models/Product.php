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

    public function getMainImageAttribute($value)
    {
        if (!$value) return null;
        return \Illuminate\Support\Str::startsWith($value, ['http://', 'https://']) ? $value : asset('storage/' . $value);
    }

    public function getThumbnailImagesAttribute($value)
    {
        $thumbnails = json_decode($value, true) ?: [];
        return array_map(function ($thumb) {
            return \Illuminate\Support\Str::startsWith($thumb, ['http://', 'https://']) ? $thumb : asset('storage/' . $thumb);
        }, $thumbnails);
    }
}

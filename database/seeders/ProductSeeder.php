<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Wer Hat',
                'description' => 'A premium minimalist hat designed for everyday wear. Featuring high-quality embroidery and an adjustable fit.',
                'price' => 35.00,
                'stock' => 100,
                'main_image' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?auto=format&fit=crop&q=80&w=1000',
                'thumbnail_images' => [
                    'https://images.unsplash.com/photo-1576872481759-c28473952f50?auto=format&fit=crop&q=80&w=1000',
                    'https://images.unsplash.com/photo-1556306535-0f09a537f0a3?auto=format&fit=crop&q=80&w=1000'
                ],
                'sizes_available' => ['One Size'],
                'colors_available' => ['Black', 'White', 'Beige']
            ],
            [
                'name' => 'Wer T-shirt',
                'description' => 'The perfect heavyweight T-shirt. Made from 100% organic cotton with a modern, relaxed boxy cut.',
                'price' => 45.00,
                'stock' => 150,
                'main_image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&q=80&w=1000',
                'thumbnail_images' => [
                    'https://images.unsplash.com/photo-1562157873-818bc0726f68?auto=format&fit=crop&q=80&w=1000',
                    'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&q=80&w=1000'
                ],
                'sizes_available' => ['S', 'M', 'L', 'XL'],
                'colors_available' => ['Black', 'White', 'Navy']
            ],
            [
                'name' => 'Wer Hoodie',
                'description' => 'Our signature heavyweight hoodie. Ultra-soft fleece interior and a structured hood for the ultimate comfort.',
                'price' => 85.00,
                'stock' => 80,
                'main_image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&q=80&w=1000',
                'thumbnail_images' => [
                    'https://images.unsplash.com/photo-1578587018452-892bacefd3f2?auto=format&fit=crop&q=80&w=1000',
                    'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&q=80&w=1000'
                ],
                'sizes_available' => ['S', 'M', 'L', 'XL'],
                'colors_available' => ['Black', 'Gray', 'Sand']
            ],
            [
                'name' => 'Wer Pants',
                'description' => 'Minimalist joggers designed for versatility. Tailored fit with premium ribbed cuffs and hidden pockets.',
                'price' => 75.00,
                'stock' => 60,
                'main_image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&q=80&w=1000',
                'thumbnail_images' => [
                    'https://images.unsplash.com/photo-1552902865-b72c031ac5ea?auto=format&fit=crop&q=80&w=1000',
                    'https://images.unsplash.com/photo-1605518216938-7c31b7b14ad0?auto=format&fit=crop&q=80&w=1000'
                ],
                'sizes_available' => ['S', 'M', 'L', 'XL'],
                'colors_available' => ['Black', 'Navy', 'Olive']
            ],
        ];

        foreach ($products as $productData) {
            $productData['slug'] = Str::slug($productData['name']);
            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }
    }
}

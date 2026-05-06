<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        Admin::updateOrCreate(
            ['username' => 'admin'],
            ['password' => Hash::make('password')]
        );

        // Categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Home & Living', 'slug' => 'home-living'],
            ['name' => 'Sporting Goods', 'slug' => 'sporting-goods'],
            ['name' => 'Accessories', 'slug' => 'accessories'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Products
        $productData = [
            ['name' => 'Wireless Headphones', 'category_id' => 1, 'price' => 199.99, 'stock' => 50, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000', 'desc' => 'Premium noise-cancelling wireless headphones.'],
            ['name' => 'Smartphone X', 'category_id' => 1, 'price' => 999.99, 'stock' => 20, 'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1000', 'desc' => 'Latest flagship smartphone with a stunning display.'],
            ['name' => 'Leather Jacket', 'category_id' => 2, 'price' => 249.99, 'stock' => 15, 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1000', 'desc' => 'Handcrafted genuine leather jacket.'],
            ['name' => 'Running Shoes', 'category_id' => 4, 'price' => 129.99, 'stock' => 100, 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1000', 'desc' => 'High-performance running shoes for enthusiasts.'],
            ['name' => 'Minimalist Watch', 'category_id' => 5, 'price' => 159.99, 'stock' => 40, 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1000', 'desc' => 'Elegant minimalist watch with leather strap.'],
            ['name' => 'Coffee Maker', 'category_id' => 3, 'price' => 79.99, 'stock' => 30, 'image' => 'https://images.unsplash.com/photo-1517633710910-3333e9da9680?q=80&w=1000', 'desc' => 'Automatic drip coffee maker for the perfect brew.'],
            ['name' => 'Canvas Backpack', 'category_id' => 5, 'price' => 89.99, 'stock' => 25, 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1000', 'desc' => 'Durable canvas backpack for daily use.'],
            ['name' => 'Ceramic Vase', 'category_id' => 3, 'price' => 45.00, 'stock' => 12, 'image' => 'https://images.unsplash.com/photo-1581783898377-1c85bf937427?q=80&w=1000', 'desc' => 'Hand-painted ceramic vase for home decor.'],
            ['name' => 'Yoga Mat', 'category_id' => 4, 'price' => 35.50, 'stock' => 60, 'image' => 'https://images.unsplash.com/photo-1592432678016-e910b452f9a2?q=80&w=1000', 'desc' => 'Non-slip yoga mat for a stable practice.'],
            ['name' => 'Laptop Pro 16', 'category_id' => 1, 'price' => 2499.00, 'stock' => 10, 'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=1000', 'desc' => 'Powerful laptop for creative professionals.'],
        ];

        foreach ($productData as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'slug' => Str::slug($p['name']),
                    'category_id' => $p['category_id'],
                    'description' => $p['desc'],
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'image' => $p['image'],
                ]
            );
        }

        // Mock Orders
        $customers = [
            ['name' => 'John Doe', 'email' => 'john@example.com'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['name' => 'Michael Ross', 'email' => 'mike@example.com'],
        ];

        foreach ($customers as $c) {
            $order = Order::create([
                'customer_name' => $c['name'],
                'customer_email' => $c['email'],
                'customer_phone' => '123456789',
                'address' => '123 Street, City, Country',
                'total' => 0,
                'status' => 'pending',
            ]);

            $total = 0;
            $items = Product::inRandomOrder()->take(rand(1, 3))->get();
            foreach ($items as $item) {
                $qty = rand(1, 2);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $qty,
                    'price' => $item->price,
                ]);
                $total += $item->price * $qty;
            }
            $order->update(['total' => $total]);
        }
    }
}

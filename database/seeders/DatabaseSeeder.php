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

        // $this->call([
        //     ProductSeeder::class,
        // ]);
    }
}

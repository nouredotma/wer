<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.home', compact('products'));
    }

    public function about()
    {
        return view('shop.about');
    }
}

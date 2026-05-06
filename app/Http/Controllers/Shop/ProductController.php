<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.products', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('shop.product-detail', compact('product'));
    }
}

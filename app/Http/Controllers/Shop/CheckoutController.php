<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('shop.checkout');
    }

    public function store(Request $request)
    {
        // coming soon
    }
}

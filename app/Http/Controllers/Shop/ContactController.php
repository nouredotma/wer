<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('shop.contact');
    }

    public function send(Request $request)
    {
        // coming soon
    }
}

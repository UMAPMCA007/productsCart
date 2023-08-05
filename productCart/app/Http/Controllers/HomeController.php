<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products=\App\Models\Product::all();
        $carts=\App\Models\Cart::all();
        return view('welcome',compact('products','carts'));
    }
}

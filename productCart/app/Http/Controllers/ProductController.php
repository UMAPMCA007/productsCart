<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
            $products = \App\Models\Product::all();
            return view('dashboard',compact('products'));

    }


    public function store(Request $request)
    {
        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/product/',$filename);
            $product->image = $filename;
        }else{
            return $request;
            $product->image = '';
        }
        $product->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $product = \App\Models\Product::find($id);
        return view('EditProduct',compact('product'));
    }

    public function update(Request $request,$id)
    {
        $product = \App\Models\Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/product/',$filename);
            $product->image = $filename;
        }
        $product->save();

        return redirect('/dashboard');
    }

    public function delete($id)
    {
        $product = \App\Models\Product::find($id);
        $product->delete();
        return redirect()->back();
    }

    public function buy($id)
    {
        $product = \App\Models\Product::find($id);

        $productName=$product->name;
        $productPrice=$product->price;
        $productCount=1;
        $productPrice=$product->price;

        $carts = \App\Models\Cart::all();
        foreach($carts as $cart){
            if($cart->productName == $productName){

                $productPrice= $productPrice+=$product->price;
                $productCount=$productPrice/$product->price;
                $cartDel=\App\Models\Cart::where('productName',$productName)->delete();
         }
        }

        $cartProduct= new \App\Models\Cart;
        $cartProduct->productName=$productName;
        $cartProduct->productCount=$productCount;
        $cartProduct->productPrice=$productPrice;
        $cartProduct->productImage=$product->image;

        $cartProduct->save();
        return redirect()->back();


    }

    public function cart()
    {

        $products = \App\Models\Cart::all();

        return view('cart',compact('products'));
    }
}

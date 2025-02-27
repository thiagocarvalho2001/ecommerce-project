<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    public function index()
    {
        # $cart = session()->get('cart', []);
        $products = Product::all(); 
        return view('cart.index', compact('products'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }
}

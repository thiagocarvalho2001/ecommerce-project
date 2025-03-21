<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class BuyController extends Controller
{
    public function buyNow(Product $product)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }

        $buyOrder = BuyOrder::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1,
            'total' => $product->preco,
        ]);

        return redirect()->route('checkout')->with('success', 'Order placed');
    }
}

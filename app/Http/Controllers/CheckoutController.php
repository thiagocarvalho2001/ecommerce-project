<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)){
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        return view('checkout.index', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
        ]);

        $cart = session()->get('cart', []);
        if(empty($cart)){
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'total_price' => $totalPrice,
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                ]);
    }


    session()->forget('cart');

    return redirect()->route('checkout.success', ['order' => $order->id]);
}

    public function success($orderId){
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('checkout.success', compact('order'));    
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkout()
    {
        if(!Auth::user()->cart || Auth::user()->cart->sum('total_price') <= 0){
            session()->flash('error', 'Cart is empty!');
            return redirect()->route('products.index');
        }
        return view('checkout.index');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'card_name' => 'required',
            'stripToken' => 'required',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try{
            $charge = Charge::create([
                'amount' => Auth::user()->cart->sum('total_price') * 100,
                'currency' => 'usd',
                'description' => 'Order Payment',
                'source' => $request->stripeToken,
            ]);

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => Auth::user()->cart->sum('total_price'),
                'status' => 'Processing',
                'payment_id' => $charge->id,
            ]);

            Auth::user()->cart()->delete();
            

            return redirect()->route('order.history')->with('success', 'Payment sucessful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment failed!');   
        }
           
    }
}

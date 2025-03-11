<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index(){
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->get();
        $total_spent = Order::where('user_id', $user->id)->sum('total_price');

        return view('customer.dashboard', compact('user', 'orders', 'total_spent'));
    }
}

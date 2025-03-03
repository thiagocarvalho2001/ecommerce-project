<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with('items.product')->orderBy('created_at', 'desc')->get();
        return view('order.index', compact('orders'));
    }
}

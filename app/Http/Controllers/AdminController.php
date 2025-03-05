<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::count();
        $products = Product::count();
        return view('admin.dashboard', compact('orders', 'products'));
    }

    public function orders()
    {
        $orders = Order::with('item.product')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders')->with('success', 'Order updated!');
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create($request->only('name', 'price'));
        return redirect()->route('admin.products')->with('success', 'Product added!');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->only('name', 'price'));
        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }

    public function deletedProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }
}

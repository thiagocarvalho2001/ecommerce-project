<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders_count = Order::count();
        $total_sales = Order::sum('total_price');
        $products_count = Product::count();
        $pending = Order::where('status', 'Pending')->count();
        $shipped = Order::where('status', 'Shipped')->count();
        $delivered = Order::where('status', 'Delivered')->count();
        $cancelled = Order::where('status', 'Canceled')->count();

        return view('admin.dashboard', compact('orders_count', 'products_count', 'total_sales', 'pending', 'shipped', 'delivered', 'cancelled'));
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
        $categories = Category::all();
        return view('admin.products', compact('products', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'stock' => 'required|numeric'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $request->merge(['image' => 'images/' . $imageName]);
        }

        Product::create($request->only('name', 'price', 'description', 'image', 'category_id', 'stock'));
        return redirect()->route('admin.products')->with('success', 'Product added!');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'stock' => 'required|numeric'
        ]);

        $product->update($request->only('name', 'price', 'description', 'image', 'category_id', 'stock'));
        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }

    public function deletedProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }
}

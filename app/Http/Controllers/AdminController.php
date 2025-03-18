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

        $sales_data = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
                    ->groupBy('date')
                    ->orderBy('date', 'ASC')
                    ->get();

        $sales_dates = $sales_data->pluck('date')->toArray();
        $sales_totals = $sales_data->pluck('total')->toArray();

        return view('admin.dashboard', compact('orders_count', 'products_count', 
            'total_sales', 'pending', 'shipped', 'delivered', 'cancelled',
            'sales_dates', 'sales_totals'));
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

        $imagePath = $request->file('image')->store('products', 'public');

        $fileName = basename($imagePath);

        Product::create(['name' => $request->name,
        'price' => $request->price, 
        'description' => $request->description,
        'image' => $fileName,
        'category_id' => $request->category_id,
        'stock' => $request->stock
    ]);

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

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function add($id)
    {
        if (!Auth::check()){
            return redirect()->route('login')->with('error', 'Login first');
        }

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);

        return back()->with('success', 'Added to the list!');
    }

    public function remove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return back()->with('success', 'Removed from the list!');
    }
}

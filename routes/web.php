<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WishlistController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('/products', ProductController::class);

Auth::routes();

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/admin/orders/{order}/update', [AdminController::class, 'updateOrder'])->name('admin.orders.update');

    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::post('/admin/products/{product}/update', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{product}/delete', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

require __DIR__.'/auth.php';

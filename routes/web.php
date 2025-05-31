<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyNowController;
use App\Http\Controllers\CartController;  // Tambahkan ini

// Detail produk
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Buy Now
Route::post('/buy-now/{product}', [BuyNowController::class, 'buyNow'])->middleware('auth')->name('buy.now');

// Add to Cart
Route::post('/cart/add/{product}', [CartController::class, 'add'])->middleware('auth')->name('cart.add');

Route::get('/check-login', [AuthenticatedSessionController::class, 'checkLoginStatus']);

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

require __DIR__.'/auth.php';

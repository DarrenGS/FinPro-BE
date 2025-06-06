<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyNowController;
use App\Http\Controllers\CartController;  // Tambahkan ini
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReceiptController;

Route::get('/receipt/{order}', [ReceiptController::class, 'show'])->name('receipt.show');

Route::middleware('auth')->group(function () {
    Route::post('/add-to-cart', [CartController::class, 'add'])->name('add-to-cart');
    Route::post('/buy-now', [OrderController::class, 'buyNow'])->name('buy-now');
});

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

// Tampilkan halaman cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->middleware('auth')->name('cart.remove');
Route::post('/cart/{cart}/checkout', [CartController::class, 'checkout'])->name('cart.checkout');



require __DIR__.'/auth.php';

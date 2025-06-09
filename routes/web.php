<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BuyNowController;
use App\Models\Product;
use App\Http\Controllers\Products;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

Route::get('/products/{id}', [Products::class, 'show'])->name('sweets.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/balance/topup', [ProfileController::class, 'showTopUpForm'])->name('balance.topup.form');
    Route::post('/balance/topup', [ProfileController::class, 'processTopUp'])->name('balance.topup.process');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{cart}/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/{cart}/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('/buy-now/{product}', [BuyNowController::class, 'buyNow'])->name('buy.now'); 

    Route::get('/receipt/{order}', [ReceiptController::class, 'show'])->name('receipt.show'); 
});


Route::get('/', [Products::class, 'index'])->name('home');


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class);
    });

require __DIR__.'/auth.php';

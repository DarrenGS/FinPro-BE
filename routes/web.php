<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/check-login', [AuthenticatedSessionController::class, 'checkLoginStatus']);

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart; // Pastikan model Cart ada

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        // Validasi stok produk
        if ($product->stock < 1) {
            return redirect()->back()->withErrors('Stock produk habis!');
        }

        // Cek apakah produk sudah ada di cart user
        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, tambah quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
}

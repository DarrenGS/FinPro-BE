<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BuyNowController extends Controller
{
    public function buyNow(Request $request, Product $product)
    {
        $user = Auth::user();

        // Validasi quantity minimal 1 dan tidak lebih dari stock produk
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $quantity = $request->input('quantity');

        $totalPrice = $product->price * $quantity;

        if ($user->money < $totalPrice) {
            return back()->with('error', 'Saldo Anda tidak cukup untuk membeli produk ini.');
        }

        $product->stock -= $quantity;
        $product->save();

        // Kurangi uang user
        $user->money -= $totalPrice;
        $user->save();


        return redirect()->route('sweets.detail', $product->id)->with('success', 'Pembelian berhasil!');
    }
}

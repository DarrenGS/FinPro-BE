<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderDetail;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
{
    // dd($product); 
    // Validasi input quantity
    $request->validate([
        'quantity' => 'required|integer|min:1|max:' . $product->stock,
    ]);

    $quantity = $request->input('quantity');

    if ($product->stock < $quantity) {
        return redirect()->back()->withErrors('Stock produk tidak cukup untuk jumlah yang diminta!');
    }

    // Cek apakah produk sudah ada di cart user
    $cartItem = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

    if ($cartItem) {
        // Jika sudah ada, tambah quantity sesuai input
        $cartItem->quantity += $quantity;

        // Optional: cek total quantity tidak melebihi stok
        if ($cartItem->quantity > $product->stock) {
            return redirect()->back()->withErrors('Total quantity di keranjang melebihi stok produk!');
        }

        $cartItem->save();
    } else {
        // Jika belum ada, buat baru dengan quantity input
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

    }
    // Lihat isinya sebelum validasi
    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}

    public function index()
    {
        $cartItems = [];

        if (auth()->check()) {
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->get();
        }

        return view('cart.index', compact('cartItems'));
    }
    public function remove(Cart $cart)
{
    // Pastikan cart milik user yang login
    if ($cart->user_id !== auth()->id()) {
        abort(403);
    }

    $cart->delete();

    return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
}

public function checkout(Cart $cart)
{ 
    // Validasi kepemilikan cart
    if ($cart->user_id !== auth()->id()) {
        abort(403);
    }

    $user = auth()->user();
    $product = $cart->product;

    // Hitung total harga produk di cart item ini
    $totalPrice = $cart->product->price * $cart->quantity;

    // Cek saldo user cukup atau tidak
    if ($user->money < $totalPrice) {
        return redirect()->back()->withErrors('Saldo tidak cukup untuk melakukan checkout ini.');
    }

    // Cek stok produk cukup atau tidak
    if ($cart->product->stock < $cart->quantity) {
        return redirect()->back()->withErrors('Stok produk tidak cukup untuk checkout ini.');
    }

    // Kurangi stok produk
    $cart->product->stock -= $cart->quantity;
    $cart->product->save();

    // Kurangi saldo user dan simpan
    $user->money -= $totalPrice;
    $user->save();

    // Buat data order baru
    $order = Order::create([
        'user_id' => $user->id,
        'total_price' => $totalPrice,
    ]);

    // Tambahkan ke order_details
    OrderDetail::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => $cart->quantity,
        'price' => $product->price,
    ]);


    // Hapus item dari cart
    $cart->delete();

    // Redirect ke halaman receipt dengan id order
    return redirect()->route('receipt.show', $order->id)
                     ->with('success', 'Checkout produk berhasil! Berikut kuitansi pembelian.');
}

}

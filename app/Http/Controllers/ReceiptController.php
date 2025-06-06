<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ReceiptController extends Controller
{
    // Menampilkan kuitansi berdasarkan ID order
    public function show($orderId)
    {
        // Ambil order beserta detail produk
        $order = Order::with(['orderDetails.product', 'user'])->findOrFail($orderId);

        // Cek kepemilikan order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this receipt.');
        }

        return view('receipt.show', compact('order'));
    }
}

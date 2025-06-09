@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-center mb-6">🧾 Kuitansi Pembelian</h2>

        <div class="mb-4 text-gray-700">
            <p><strong>Tanggal Pembelian:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Total Harga:</strong> <span class="text-green-600 font-semibold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span></p>
        </div>

        <hr class="my-4">

        <h3 class="text-lg font-semibold mb-3">📦 Detail Produk</h3>
        <ul class="space-y-4">
            @foreach ($order->orderDetails as $detail)
                <li class="border-b pb-2">
                    <div class="font-medium">{{ $detail->product->name }}</div>
                    <div class="text-sm text-gray-600">
                        Qty: {{ $detail->quantity }} × Rp{{ number_format($detail->price, 0, ',', '.') }}<br>
                        <span class="font-semibold">Subtotal:</span> Rp{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 text-center">
            <a href="{{ route('cart.index') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                ⬅️ Kembali ke Keranjang
            </a>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">🛒 Keranjang Belanja</h2>

    {{-- Tampilkan notifikasi error --}}
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-300 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tampilkan notifikasi success --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <ul class="space-y-4">
            @foreach($cartItems as $item)
                <li class="p-4 bg-white shadow rounded flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <p class="font-bold text-pink-600">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>

                        {{-- Form Remove --}}
                        <form action="{{ route('cart.remove', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus produk ini dari keranjang?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Remove</button>
                        </form>

                        {{-- Form Checkout per item --}}
                        <form action="{{ route('cart.checkout', $item) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">
                                Checkout
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Keranjang kamu kosong.</p>
    @endif
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <div class="flex flex-col md:flex-row gap-6">
        <div class="md:w-1/2">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded">
        </div>
        <div class="md:w-1/2">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
            <p class="text-xl text-pink-600 font-semibold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-gray-700 mb-4">{{ $product->description }}</p>
            <p class="text-sm text-gray-500 mb-6">Stock: {{ $product->stock }}</p>

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- Display General Error Message --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Display Success Message --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('cart.add', $product) }}" class="inline-block mr-2">
                @csrf
                <label for="quantity_cart" class="sr-only">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity_cart"
                    min="1"
                    max="{{ $product->stock }}"
                    value="1"
                    class="border rounded px-2 py-1 w-20 mr-2"
                    required
                >
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Add to Cart
                </button>
            </form>

            {{-- Form Buy Now dengan input quantity --}}
            <form method="POST" action="{{ route('buy.now', $product) }}" class="inline-block">
                @csrf
                <label for="quantity_buy" class="sr-only">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity_buy"
                    min="1"
                    max="{{ $product->stock }}"
                    value="1"
                    class="border rounded px-2 py-1 w-20 mr-2"
                    required
                >
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Buy Now
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
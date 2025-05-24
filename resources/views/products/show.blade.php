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

            {{-- sementara --}}
            <a href="#" class="inline-block mr-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Add to Cart
            </a>

            <a href="#" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Buy Now
            </a>

            {{-- <form method="POST" action="{{ route('cart.add', $product->id) }}" class="inline-block mr-2">
                @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Add to Cart
                </button>
            </form>

            <form method="POST" action="{{ route('checkout.buy', $product->id) }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Buy Now
                </button>
            </form> --}}
        </div>
    </div>
</div>
@endsection

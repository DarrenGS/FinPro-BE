@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-pink-600">All Sweets 🍬</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded shadow p-4">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded mb-2">
                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                <p class="mt-2 font-bold text-pink-600">Rp{{ number_format($product->price) }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="block mt-2 text-center text-white bg-indigo-600 px-4 py-2 rounded hover:bg-indigo-700">Product Detail</a>
            </div>
        @endforeach
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-pink-600">All Sweets 🍬</h1>
    <form method="GET" action="{{ route('home') }}" class="mb-4 flex gap-4">
        <input type="text" name="search" placeholder="Search product..." class="border rounded p-2 w-full" value="{{ request('search') }}">
        <select name="price_range" class="border rounded p-2">
            <option value="">All Prices</option>
            <option value="0-20000" @selected(request('price_range') == '0-20000')>Rp 0 - 20.000</option>
            <option value="20001-50000" @selected(request('price_range') == '20001-50000')>Rp 20.000 - 50.000</option>
            <option value="50001-100000" @selected(request('price_range') == '50001-100000')>Rp 50.000 - 100.000</option>
            <option value="100001-above" @selected(request('price_range') == '100001-above')>Rp >100.000</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    @if($products->isEmpty())
        <p class="text-gray-500">No products found.</p>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded shadow p-4">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover rounded mb-2">
                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                <p class="mt-2 font-bold text-pink-600">Rp{{ number_format($product->price) }}</p>
                <a href="{{ route('sweets.detail', $product->id) }}" class="block mt-2 text-center text-white bg-indigo-600 px-4 py-2 rounded hover:bg-indigo-700">Product Detail</a>
            </div>
        @endforeach
    </div>
    @endif
@endsection
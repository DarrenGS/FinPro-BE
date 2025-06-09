@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Product List</h1>

    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4 flex gap-4">
        <input type="text" name="search" placeholder="Search product..." class="border rounded p-2 w-full" value="{{ request('search') }}">
        <select name="filter" class="border rounded p-2">
            <option value="">All</option>
            <option value="low-stock" @selected(request('filter') == 'low-stock')>Low Stock (&lt;=5)</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('admin.products.create') }}" class="ml-auto bg-green-500 text-white px-4 py-2 rounded">Add Product</a>
    </form>

    @if($products->isEmpty())
        <p class="text-gray-500">No products found.</p>
    @else
        <table class="w-full border table-auto">
            <thead>
                <tr class="bg-purple-200 text-left">
                    <th class="p-2">Image</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Stock</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-t">
                         <td class="p-2">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded">
                            @else
                                <span class="text-gray-400 italic">No image</span>
                            @endif
                        </td>
                        <td class="p-2">{{ $product->name }}</td>
                        <td class="p-2">Rp{{ number_format($product->price) }}</td>
                        <td class="p-2">{{ $product->stock }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

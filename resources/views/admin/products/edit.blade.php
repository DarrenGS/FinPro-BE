@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Name</label>
            <input name="name" class="w-full border p-2" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-4">
            <label>Price</label>
            <input type="number" name="price" class="w-full border p-2" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-4">
            <label>Stock</label>
            <input type="number" name="stock" class="w-full border p-2" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-4">
            <label>Description</label>
            <textarea name="description" class="w-full border p-2" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label>Current Image</label><br>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="h-24 w-24 object-cover rounded mb-2">
            @else
                <p class="text-gray-500 italic">No image uploaded</p>
            @endif
        </div>

        <div class="mb-4">
            <label>New Image (optional)</label>
            <input type="file" name="image" class="w-full border p-2">
        </div>

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update Product</button>
        <a href="{{ route('admin.products.index') }}" class="ml-2 text-blue-500">Cancel</a>
    </form>
</div>
@endsection

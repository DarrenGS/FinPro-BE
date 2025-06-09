@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Add New Product</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <div class="mb-4">
            <label>Name</label>
            <input name="name" class="w-full border p-2" required>
        </div>
        <div class="mb-4">
            <label>Price</label>
            <input type="number" name="price" class="w-full border p-2" required>
        </div>
        <div class="mb-4">
            <label>Stock</label>
            <input type="number" name="stock" class="w-full border p-2" required>
        </div>
        <div class="mb-4">
            <label>Description</label>
            <textarea name="description" class="w-full border p-2"></textarea>
        </div>

         <div class="mb-4">
            <label>Image</label>
            <input type="file" name="image" class="w-full border p-2">
        </div>
        <button class="bg-green-500 text-white px-4 py-2 rounded">Add Product</button>
    </form>

    @if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</div>
@endsection

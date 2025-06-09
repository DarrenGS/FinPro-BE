<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class Products extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();

        // Fitur Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Range Harga
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case '0-20000':
                    $query->whereBetween('price', [0, 20000]);
                    break;
                case '20001-50000':
                    $query->whereBetween('price', [20001, 50000]);
                    break;
                case '50001-100000':
                    $query->whereBetween('price', [50001, 100000]);
                    break;
                case '100001-above':
                    $query->where('price', '>', 100000);
                    break;
            }
        }

        $products = $query->orderBy('name')->get();

        return view('sweets.index', compact('products'));
    }
        public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('sweets.detail', compact('product'));
    }
}

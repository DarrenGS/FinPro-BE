@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
        <a href="{{ route('admin.products.index') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition duration-200">
            Manage Products
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white shadow p-4 rounded text-center">
            <p class="text-gray-600">Total Products:</p>
            <strong class="text-2xl text-green-600">{{ $totalProducts }}</strong>
        </div>
        <div class="bg-white shadow p-4 rounded text-center">
            <p class="text-gray-600">Total Users:</p>
            <strong class="text-2xl text-blue-600">{{ $totalUsers }}</strong>
        </div>
        <div class="bg-white shadow p-4 rounded text-center">
            <p class="text-gray-600">Total Revenue:</p>
            <strong class="text-2xl text-purple-600">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</strong>
        </div>
    </div>

    <div class="bg-white shadow p-4 rounded mb-8">
        <h2 class="text-xl font-bold mb-2 text-gray-800">Most Bought Product</h2>
        @if($mostBought)
            <div class="flex items-center space-x-4">
                @if($mostBought->image)
                    <img src="{{ asset('storage/' . $mostBought->image) }}" alt="{{ $mostBought->name }}" class="w-16 h-16 object-cover rounded-md shadow">
                @else
                    <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center text-gray-500 text-sm">No Image</div>
                @endif
                <div>
                    <p class="text-lg font-semibold text-gray-900">{{ $mostBought->name }}</p>
                    <p class="text-gray-600">Sold: {{ $mostBought->total_quantity_sold }} units</p>
                </div>
            </div>
        @else
            <p class="text-gray-600">No products have been sold yet.</p>
        @endif
    </div>

    ---

    {{-- Order History Section --}}
    <div class="bg-white shadow p-4 rounded">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Order History</h2>

        @if($orders->isEmpty())
            <p class="text-gray-600 text-center">No orders have been placed yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                            {{-- Add more columns if needed, e.g., 'Status' --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $order->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($order->orderDetails as $detail)
                                            <li>
                                                {{ $detail->quantity }} x {{ $detail->product->name ?? 'Product Not Found' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
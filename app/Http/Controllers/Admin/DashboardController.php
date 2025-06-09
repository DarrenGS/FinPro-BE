<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $totalProducts = Product::count();
    $totalRevenue = Order::sum('total_price');

    $mostBought = Product::join('order_details', 'products.id', '=', 'order_details.product_id')
        ->select('products.id', 'products.name', 'products.image') 
        
        ->selectRaw('SUM(order_details.quantity) as total_quantity_sold')
        ->groupBy('products.id', 'products.name', 'products.image')
        ->orderByDesc('total_quantity_sold')  
        ->first();

    $orders = Order::with(['user', 'orderDetails.product'])->latest()->get();

    return view('admin.index', compact(
        'totalUsers',
        'totalProducts',
        'totalRevenue',
        'mostBought',
        'orders'
    ));
}
}


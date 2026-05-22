<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'revenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
            'orders' => Order::count(),
            'products' => Product::count(),
            'users' => User::where('role', 'user')->count(),
        ];
        $recent = Order::with(['user', 'address'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }
}

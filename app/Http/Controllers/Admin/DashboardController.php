<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // [PERBAIKAN] Menghitung semua data yang diperlukan oleh view.
        $totalProducts = Product::count();
        $newOrdersCount = Order::where('status', 'pending')->count();
        $totalUsers = User::where('role', 'pengunjung')->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<', 10)->orderBy('stock', 'asc')->get();

        // [PERBAIKAN] Mengirim semua data yang diperlukan ke view.
        return view('admin.dashboard', compact(
            'totalProducts',
            'newOrdersCount',
            'totalUsers',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}
    
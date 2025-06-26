<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    /**
     * Menampilkan daftar riwayat pesanan milik pengguna yang sedang login.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->paginate(10);
        
        // [SESUAIKAN] Mengarahkan ke view di dalam folder 'order-history'
        return view('order-history.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan milik pengguna.
     * Method ini juga disesuaikan untuk view 'show.blade.php' Anda.
     */
    public function show(Order $order)
    {
        // Pastikan pengguna hanya bisa melihat pesanannya sendiri
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        $order->load('items.product');

        // [SESUAIKAN] Mengarahkan ke view 'show' di dalam folder 'order-history'
        return view('order-history.show', compact('order'));
    }
}

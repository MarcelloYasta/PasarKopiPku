<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        // [PERBAIKAN] Mengganti get() menjadi paginate() untuk mengatasi error
        // dan mengaktifkan fitur paginasi di halaman.
        $orders = Order::with('user')->latest()->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail dari satu pesanan.
     * Method ini sudah benar.
     */
    public function show(Order $order)
    {
        // Laravel secara otomatis akan mencari Order berdasarkan ID dari URL.
        // Kita juga memuat relasi 'items' dan 'product' di dalamnya untuk efisiensi.
        $order->load('items.product');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mengupdate status dari sebuah pesanan.
     * Method ini sudah benar.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string|in:pending,processing,shipped,completed,cancelled']);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}

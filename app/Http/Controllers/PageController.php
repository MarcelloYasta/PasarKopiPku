<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <-- Jangan lupa import Model Product

class PageController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage).
     */
    public function home()
    {
        // Ambil 4 produk terbaru dari database untuk ditampilkan sebagai produk unggulan
        $featuredProducts = Product::with('category')->latest()->take(4)->get();

        // Kirim data produk tersebut ke view 'welcome'
        return view('welcome', compact('featuredProducts'));
    }
}
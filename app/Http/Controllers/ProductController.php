<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman daftar produk dengan filter kategori dan paginasi.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk ditampilkan di sidebar
        $categories = Category::all();

        // Query dasar untuk produk
        $productsQuery = Product::with('category');

        // Jika ada permintaan filter berdasarkan kategori
        if ($request->has('kategori')) {
            $slug = $request->kategori;
            $productsQuery->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
        }

        // Ambil produk, urutkan dari yang terbaru, dan bagi per halaman
        $products = $productsQuery->latest()->paginate(9)->withQueryString();

        // Kirim data kategori dan produk ke view
        return view('produk', compact('products', 'categories'));
    }
}
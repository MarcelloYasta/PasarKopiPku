<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman utama (landing page).
     */
    public function home()
    {
        // Nantinya kita bisa mengirim data produk dari sini
        return view('welcome');
    }
}
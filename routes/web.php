<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController; 

// Rute untuk menampilkan Landing Page
Route::get('/', [PageController::class, 'home'])->name('home');

// Rute untuk Halaman Produk
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');

// Rute untuk Halaman Keranjang
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');


// --- BAGIAN AUTENTIKASI ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// [TERBARU] Rute untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// --- BAGIAN KHUSUS ADMIN ---
Route::middleware(['auth', 'admin'])->group(function () {
    // Semua rute yang ada di dalam grup ini hanya bisa diakses oleh admin
    
    Route::get('/admin/dashboard', function () {
        return 'Ini Halaman Dasbor Admin (Akses Diberikan!)';
    })->name('admin.dashboard');

    // Contoh: Rute admin untuk manajemen produk
    // Route::get('/admin/products', [AdminProductController::class, 'index']);
});
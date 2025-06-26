<?php

use Illuminate\Support\Facades\Route;
// Controller untuk Pengunjung
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
// Controller untuk Autentikasi
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
// Controller untuk Riwayat Pesanan
use App\Http\Controllers\OrderHistoryController;
// Controller untuk Panel Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Rute untuk Pengunjung (Frontend)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');

/*
|--------------------------------------------------------------------------
| Rute untuk Keranjang Belanja (Cart)
|--------------------------------------------------------------------------
*/
Route::controller(CartController::class)->prefix('keranjang')->name('cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/tambah/{product}', 'add')->name('add');
    Route::post('/update', 'update')->name('update');
    Route::post('/hapus', 'remove')->name('remove');
});

/*
|--------------------------------------------------------------------------
| Rute untuk Autentikasi (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Rute untuk Pengguna yang Sudah Login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // [PERBAIKAN] Grup rute untuk Riwayat Pesanan Pelanggan
    Route::controller(OrderHistoryController::class)->group(function() {
        Route::get('/riwayat-pesanan', 'index')->name('order.history');
        Route::get('/riwayat-pesanan/{order}', 'show')->name('order.show');
    });

    // Rute untuk proses checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});


/*
|--------------------------------------------------------------------------
| Rute untuk Panel Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dasbor
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Produk (CRUD)
    Route::resource('products', AdminProductController::class);
    
    // Manajemen Pesanan
    Route::controller(OrderController::class)->prefix('orders')->name('orders.')->group(function () { 
        Route::get('/', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
        Route::post('/{order}/update-status', 'updateStatus')->name('updateStatus');
    });
    
    // Manajemen Pengguna
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

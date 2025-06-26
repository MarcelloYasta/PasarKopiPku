<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman/form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses autentikasi.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // [SEMPURNA] Cek role menggunakan accessor dan redirect ke nama rute
            if (auth()->user()->is_admin) {
                // Perbaikan utama: Mengarahkan ke rute 'admin.dashboard'
                return redirect()->intended(route('admin.dashboard'));
            }

            // Sesuai permintaan: Mengarahkan pengguna biasa ke halaman produk
            return redirect()->intended(route('products.index'));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
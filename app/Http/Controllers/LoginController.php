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
        // Cukup tampilkan view-nya saja
        return view('auth.login');
    }

    /**
     * Menangani proses autentikasi.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba lakukan login (autentikasi)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Cek Role dan Arahkan (Otorisasi)
            if (auth()->user()->role === 'admin') {
                return redirect()->intended('/admin'); // Arahkan admin ke dasbornya
            }

            return redirect()->intended('/'); // Arahkan pengunjung ke halaman utama
        }

        // 4. Jika login gagal
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
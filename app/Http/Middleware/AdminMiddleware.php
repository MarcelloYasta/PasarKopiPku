<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login DAN perannya adalah 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Jika ya, izinkan akses ke halaman selanjutnya
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman utama
        return redirect('/');
    }
}
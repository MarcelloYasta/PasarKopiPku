{{-- Menggunakan layout utama Anda, jika ada --}}
@extends('layouts.app') 

@section('content')
<style>
    /* Anda bisa meletakkan CSS ini di file app.css utama Anda */
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh; /* Agar form berada di tengah halaman */
        padding: 2rem 1rem;
    }

    .login-card {
        background-color: #4a4a4a; /* Warna abu-abu gelap seperti kartu produk */
        padding: 2.5rem 2rem;
        border-radius: 8px;
        width: 100%;
        max-width: 450px; /* Lebar maksimum form */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .login-card h2 {
        font-family: 'Georgia', serif; /* Font yang mirip dengan "Koleksi Kopi Nusantara" */
        color: #E0E0E0;
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        color: #cccccc;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        background-color: #333333;
        border: 1px solid #666666;
        border-radius: 4px;
        color: #ffffff;
        font-size: 1rem;
    }

    .form-control:focus {
        outline: none;
        border-color: #c58c5a; /* Warna tombol sebagai highlight */
    }

    .btn-login {
        width: 100%;
        padding: 0.85rem;
        background-color: #c58c5a; /* Warna yang sama dengan tombol "Tambah ke Keranjang" */
        border: none;
        border-radius: 4px;
        color: #ffffff;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #b37b4f;
    }
    
    .register-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .register-link a {
        color: #c58c5a;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    /* Menampilkan error validasi */
    .alert-danger {
        color: #ff9e9e;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

</style>

<div class="login-container">
    <div class="login-card">
        <h2>Masuk Akun</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf  {{-- Token Keamanan Wajib di Laravel --}}

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                
                @error('email')
                    <div class="alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn-login">
                    Masuk
                </button>
            </div>
            
            <div class="register-link">
                <p style="color:#cccccc;">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
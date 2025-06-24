@extends('layouts.app')

@section('content')
{{-- Kita bisa menggunakan style yang sama persis dengan halaman login --}}
<style>
    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 4rem 1rem;
    }
    .register-card {
        background-color: #4a4a4a;
        padding: 2.5rem 2rem;
        border-radius: 8px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .register-card h2 {
        font-family: 'Georgia', serif;
        color: #E0E0E0;
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2rem;
    }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label { display: block; color: #cccccc; margin-bottom: 0.5rem; }
    .form-control { width: 100%; padding: 0.75rem; background-color: #333333; border: 1px solid #666666; border-radius: 4px; color: #ffffff; font-size: 1rem; }
    .form-control:focus { outline: none; border-color: #c58c5a; }
    .btn-register { width: 100%; padding: 0.85rem; background-color: #c58c5a; border: none; border-radius: 4px; color: #ffffff; font-size: 1rem; font-weight: bold; cursor: pointer; transition: background-color 0.3s ease; }
    .btn-register:hover { background-color: #b37b4f; }
    .login-link { text-align: center; margin-top: 1.5rem; }
    .login-link a { color: #c58c5a; text-decoration: none; }
    .login-link a:hover { text-decoration: underline; }
    .alert-danger { color: #ff9e9e; font-size: 0.875rem; margin-top: 0.25rem; }
</style>

<div class="register-container">
    <div class="register-card">
        <h2>Buat Akun Baru</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Input Nama Lengkap --}}
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Email --}}
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Konfirmasi Password --}}
            <div class="form-group">
                <label for="password-confirm">Konfirmasi Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group" style="margin-top: 2rem;">
                <button type="submit" class="btn-register">Daftar</button>
            </div>

            <div class="login-link">
                <p style="color:#cccccc;">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
{{-- File: resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-stone-100 flex items-center justify-center p-4">
    <div class="max-w-4xl w-full grid md:grid-cols-2 bg-white rounded-2xl shadow-2xl overflow-hidden">
        
        <!-- ================================== -->
        <!-- KOLOM KIRI: GAMBAR                 -->
        <!-- ================================== -->
        <div class="hidden md:block">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1559496417-e7f25cb247f3?q=80&w=1887&auto=format&fit=crop" alt="Secangkir Kopi Hangat">
        </div>

        <!-- ================================== -->
        <!-- KOLOM KANAN: FORM LOGIN            -->
        <!-- ================================== -->
        <div class="p-8 md:p-12">
            <div class="text-center md:text-left mb-8">
                <a href="{{ route('home') }}" class="inline-block font-serif text-2xl font-bold text-yellow-900 mb-2">Pasar Kopi Pekanbaru</a>
                <h2 class="text-3xl font-bold text-stone-800">Selamat Datang Kembali!</h2>
                <p class="text-stone-600 mt-2">Silakan masuk untuk melanjutkan pesanan Anda.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-6">
                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block mb-1 font-medium text-stone-700">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                               class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:ring-yellow-900 focus:border-yellow-900 transition">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block mb-1 font-medium text-stone-700">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:ring-yellow-900 focus:border-yellow-900 transition">
                    </div>

                    <!-- Tombol Masuk -->
                    <div>
                        <button type="submit" class="w-full bg-stone-800 text-white font-bold py-3 px-4 rounded-lg hover:bg-yellow-900 transition-colors shadow-sm hover:shadow-md">
                            Masuk
                        </button>
                    </div>
                </div>
                
                <!-- Link ke Halaman Daftar -->
                <div class="text-center mt-6">
                    <p class="text-sm text-stone-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-medium text-yellow-900 hover:underline">Daftar di sini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

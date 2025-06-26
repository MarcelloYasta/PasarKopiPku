@extends('admin.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p class="mt-2 text-gray-600">Ini adalah halaman dasbor admin Anda.</p>

    {{-- Contoh Stat Card --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Total Produk</h3>
            <p class="text-3xl font-bold mt-2 text-blue-600">15</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Pesanan Baru</h3>
            <p class="text-3xl font-bold mt-2 text-green-600">5</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
            <p class="text-3xl font-bold mt-2 text-purple-600">2</p>
        </div>
    </div>
@endsection
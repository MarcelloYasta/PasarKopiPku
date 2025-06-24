{{-- File: resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Header Halaman -->
    <section class="bg-stone-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="font-serif text-5xl font-extrabold tracking-tight">Koleksi Kopi Kami</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-stone-300">Temukan biji kopi favorit Anda dari seluruh penjuru Nusantara, disangrai dengan penuh dedikasi.</p>
        </div>
    </section>

    <!-- Konten Utama: Sidebar + Grid Produk -->
    <section class="py-16 bg-stone-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- ================================== -->
                <!-- KOLOM 1: SIDEBAR KATEGORI        -->
                <!-- ================================== -->
                <aside class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md h-fit sticky top-24">
                    <h2 class="font-serif text-2xl font-bold mb-4 border-b border-stone-200 pb-3">Kategori</h2>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="block font-semibold text-yellow-900 transition hover:underline">
                                Semua Produk
                            </a>
                        </li>
                        {{-- Contoh Kategori Induk --}}
                        <li>
                            <span class="block font-semibold text-stone-800">Beans</span>
                            {{-- Contoh Sub-Kategori --}}
                            <ul class="pl-4 mt-2 space-y-2 border-l border-stone-200">
                                <li><a href="#" class="block text-sm text-stone-600 hover:text-yellow-900 transition hover:underline">- Grinded Beans</a></li>
                                <li><a href="#" class="block text-sm text-stone-600 hover:text-yellow-900 transition hover:underline">- Roasted Beans</a></li>
                            </ul>
                        </li>
                        <li>
                            <span class="block font-semibold text-stone-800">Palm Sugar</span>
                             <ul class="pl-4 mt-2 space-y-2 border-l border-stone-200">
                                <li><a href="#" class="block text-sm text-stone-600 hover:text-yellow-900 transition hover:underline">- Liquid</a></li>
                                <li><a href="#" class="block text-sm text-stone-600 hover:text-yellow-900 transition hover:underline">- Powder</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="block font-semibold text-stone-800 hover:text-yellow-900 transition">Syrup</a></li>
                    </ul>
                </aside>

                <!-- ================================== -->
                <!-- KOLOM 2: GRID DAFTAR PRODUK      -->
                <!-- ================================== -->
                <main class="lg:col-span-3">
                    @php
                        // Data statis sebagai contoh, ini akan diganti dengan variabel $products dari controller
                        $products = [
                            [ 'slug' => 'robusta-pahit-riau', 'image' => 'https://images.unsplash.com/photo-1599160539326-25f03d29944a?q=80&w=1887&auto=format&fit=crop', 'category' => (object)['name' => 'Roasted Beans'], 'name' => 'Robusta Pahit Riau', 'price' => 85000 ],
                            [ 'slug' => 'arabika-wangi-sumatera', 'image' => 'https://images.unsplash.com/photo-1621282637424-6447d288a442?q=80&w=1887&auto=format&fit=crop', 'category' => (object)['name' => 'Grinded Beans'], 'name' => 'Arabika Wangi Sumatera', 'price' => 120000 ],
                            [ 'slug' => 'liberika-unik-meranti', 'image' => 'https://images.unsplash.com/photo-1563807340802-1a3965b5333e?q=80&w=1887&auto=format&fit=crop', 'category' => (object)['name' => 'Roasted Beans'], 'name' => 'Liberika Unik Meranti', 'price' => 150000 ],
                        ];
                    @endphp
                    
                    @if (!empty($products))
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                            @foreach ($products as $product)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden group relative transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col">
                                    <div class="relative">
                                        <a href="#">
                                            <span class="absolute top-4 left-4 bg-yellow-900 text-white text-xs font-bold px-3 py-1 rounded-full z-10">{{ $product['category']->name }}</span>
                                            <img class="h-64 w-full object-cover transform group-hover:scale-110 transition-transform duration-500" 
                                                 src="{{ $product['image'] }}" 
                                                 alt="[Gambar {{ $product['name'] }}]">
                                        </a>
                                    </div>
                                    <div class="p-6 flex flex-col flex-grow">
                                        <h3 class="font-serif text-xl font-bold text-stone-900 flex-grow">
                                            <a href="#" class="hover:text-yellow-900">{{ $product['name'] }}</a>
                                        </h3>
                                        <p class="mt-4 text-lg font-semibold text-stone-800">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                                        <div class="mt-4 pt-4 border-t border-stone-100">
                                            <a href="#" class="w-full text-center inline-block bg-stone-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-yellow-900 transition-colors shadow-sm hover:shadow-md">
                                                Tambah ke Keranjang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination Links (contoh) -->
                        <div class="mt-12 text-center">
                            {{-- Ini akan berfungsi saat data dihubungkan dengan paginator Laravel --}}
                            <nav class="inline-flex rounded-md shadow-sm">
                                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">Previous</a>
                                <a href="#" class="px-4 py-2 text-sm font-medium text-white bg-yellow-900 border border-yellow-900">1</a>
                                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border-t border-b border-gray-300 hover:bg-gray-50">2</a>
                                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">Next</a>
                            </nav>
                        </div>
                    @else
                        <div class="bg-white p-12 rounded-lg shadow-md text-center">
                            <p class="text-gray-500 text-xl">Mohon maaf, tidak ada produk yang ditemukan.</p>
                            <a href="#" class="mt-4 inline-block text-yellow-900 font-bold hover:underline">Kembali ke Semua Produk &rarr;</a>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </section>
@endsection

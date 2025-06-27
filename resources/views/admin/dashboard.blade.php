{{-- File: resources/views/admin/dashboard.blade.php --}}
@extends('admin.app') {{-- Pastikan ini menunjuk ke layout admin Anda yang baru --}}

@section('title', 'Dashboard') {{-- Ini akan mengisi judul di header layout admin --}}

@section('content')
    <div class="space-y-8">
        <!-- Bagian Welcome Header -->
        <div>
            <h1 class="text-3xl font-bold font-serif text-stone-800"> {{ Auth::user()->name }}</h1>
            <p class="mt-2 text-stone-600">Ini adalah pusat kendali untuk Pasar Kopi Pekanbaru. Pantau statistik penjualan dan kelola toko Anda dari sini.</p>
        </div>

        <!-- Stat Cards (Kartu Statistik dengan Desain Baru) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Produk -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 transition-all hover:shadow-lg hover:-translate-y-1">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-stone-500">Total Produk</p>
                    <p class="text-3xl font-bold text-stone-800">15</p> {{-- Data dinamis akan masuk di sini --}}
                </div>
            </div>
            <!-- Card 2: Pesanan Baru -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 transition-all hover:shadow-lg hover:-translate-y-1">
                <div class="bg-green-100 p-3 rounded-full">
                     <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-stone-500">Pesanan Baru</p>
                    <p class="text-3xl font-bold text-stone-800">5</p> {{-- Data dinamis akan masuk di sini --}}
                </div>
            </div>
            <!-- Card 3: Total Pengguna -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 transition-all hover:shadow-lg hover:-translate-y-1">
                 <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2"></path></svg>
                 </div>
                <div>
                    <p class="text-sm font-medium text-stone-500">Total Pengguna</p>
                    <p class="text-3xl font-bold text-stone-800">2</p> {{-- Data dinamis akan masuk di sini --}}
                </div>
            </div>
            <!-- Card 4: Pendapatan -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 transition-all hover:shadow-lg hover:-translate-y-1">
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0 1H9m3 0h3m-3 10v-1m0 1h.01M12 18h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-stone-500">Pendapatan (Bulan Ini)</p>
                    <p class="text-3xl font-bold text-stone-800">Rp 1.2Jt</p> {{-- Data dinamis akan masuk di sini --}}
                </div>
            </div>
        </div>

        <!-- Bagian Pesanan Terbaru & Produk Populer -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Tabel Pesanan Terbaru -->
            <div class="xl:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg text-stone-800 mb-4">Pesanan Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-stone-500">
                        <thead class="text-xs text-stone-700 uppercase bg-stone-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID Pesanan</th>
                                <th scope="col" class="px-6 py-3">Pelanggan</th>
                                <th scope="col" class="px-6 py-3">Total</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Data statis sebagai contoh --}}
                            <tr class="bg-white border-b hover:bg-stone-50">
                                <th scope="row" class="px-6 py-4 font-medium text-stone-900 whitespace-nowrap">#1024</th>
                                <td class="px-6 py-4">Budi Setiawan</td>
                                <td class="px-6 py-4">Rp 120.000</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">Completed</span></td>
                            </tr>
                             <tr class="bg-white border-b hover:bg-stone-50">
                                <th scope="row" class="px-6 py-4 font-medium text-stone-900 whitespace-nowrap">#1023</th>
                                <td class="px-6 py-4">Anita Sari</td>
                                <td class="px-6 py-4">Rp 85.000</td>
                                <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">Processing</span></td>
                            </tr>
                             <tr class="bg-white hover:bg-stone-50">
                                <th scope="row" class="px-6 py-4 font-medium text-stone-900 whitespace-nowrap">#1022</th>
                                <td class="px-6 py-4">Joko Widodo</td>
                                <td class="px-6 py-4">Rp 150.000</td>
                                <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">Waiting Confirmation</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kartu Produk Stok Rendah -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg text-stone-800 mb-4">Produk Stok Rendah</h3>
                <ul class="space-y-4">
                    {{-- Data statis sebagai contoh --}}
                    <li class="flex items-center space-x-3">
                        <img class="w-12 h-12 rounded-md object-cover" src="https://images.unsplash.com/photo-1599160539326-25f03d29944a?q=80&w=1887&auto=format&fit=crop" alt="Robusta Riau">
                        <div>
                            <p class="font-medium text-stone-800">Robusta Pahit Riau</p>
                            <p class="text-sm text-red-600 font-bold">Stok: 3</p>
                        </div>
                    </li>
                    <li class="flex items-center space-x-3">
                         <img class="w-12 h-12 rounded-md object-cover" src="https://images.unsplash.com/photo-1563807340802-1a3965b5333e?q=80&w=1887&auto=format&fit=crop" alt="Liberika Meranti">
                         <div>
                            <p class="font-medium text-stone-800">Liberika Unik Meranti</p>
                            <p class="text-sm text-red-600 font-bold">Stok: 5</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

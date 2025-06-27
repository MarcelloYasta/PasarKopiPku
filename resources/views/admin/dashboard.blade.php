@extends('admin.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <div>
            <h1 class="text-3xl font-bold font-serif text-stone-800">Dashboard</h1>
            <p class="mt-2 text-stone-600">Ini adalah pusat kendali untuk Pasar Kopi Pekanbaru. Pantau statistik penjualan dan kelola toko Anda dari sini.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 transition-all hover:shadow-lg hover:-translate-y-1">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-stone-500">Total Produk</p>
                    <p class="text-3xl font-bold text-stone-800">{{ $totalProducts }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 transition-all hover:shadow-lg hover:-translate-y-1">
                <div class="bg-green-100 p-3 rounded-full">
                     <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-stone-500">Pesanan Baru</p>
                    <p class="text-3xl font-bold text-stone-800">{{ $newOrdersCount }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 transition-all hover:shadow-lg hover:-translate-y-1">
                 <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2"></path></svg>
                 </div>
                <div>
                    <p class="text-sm font-medium text-stone-500">Total Pengguna</p>
                    <p class="text-3xl font-bold text-stone-800">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
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
                            @forelse ($recentOrders as $order)
                                <tr class="bg-white border-b hover:bg-stone-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-stone-900 whitespace-nowrap">#{{ $order->id }}</th>
                                    <td class="px-6 py-4">{{ $order->user->name }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">{{ ucfirst($order->status) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-stone-500">Belum ada pesanan terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg text-stone-800 mb-4">Produk Stok Rendah</h3>
                <ul class="space-y-4">
                     @forelse ($lowStockProducts as $product)
                        <li class="flex items-center space-x-3">
                            <img class="w-12 h-12 rounded-md object-cover" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/100x100/f3f2ee/a18a62?text=Kopi' }}" alt="{{ $product->name }}">
                            <div>
                                <p class="font-medium text-stone-800">{{ $product->name }}</p>
                                <p class="text-sm text-red-600 font-bold">Stok: {{ $product->stock }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="text-center py-4 text-stone-500 text-sm">
                            Stok semua produk aman.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

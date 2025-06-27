@extends('admin.app')

@section('title', 'Manajemen Pesanan')

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h1 class="text-3xl font-serif font-bold text-stone-800">Manajemen Pesanan</h1>
            <p class="mt-1 text-stone-600">Lihat dan kelola semua transaksi yang masuk.</p>
        </div>
        {{-- Nanti di sini bisa ditambahkan tombol filter atau export --}}
    </div>

    {{-- DAFTAR PESANAN SEBAGAI KARTU --}}
    <div class="space-y-4">
        @forelse($orders as $order)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 items-center p-4">
                    
                    {{-- ID Pesanan & Tanggal --}}
                    <div class="col-span-2 sm:col-span-1">
                        <p class="font-bold text-stone-800">#{{ $order->id }}</p>
                        <p class="text-xs text-stone-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    {{-- Nama Pelanggan --}}
                    <div class="sm:col-span-2">
                        <p class="text-sm text-stone-500">Pelanggan</p>
                        <p class="font-semibold text-stone-800">{{ $order->user->name }}</p>
                    </div>

                    {{-- Total Pembayaran --}}
                    <div class="text-left sm:text-right">
                        <p class="text-sm text-stone-500">Total</p>
                        <p class="font-bold text-stone-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>

                    {{-- Status & Aksi --}}
                    <div class="col-span-2 sm:col-span-1 flex flex-col items-start sm:items-end space-y-2">
                        @php
                            $statusClass = 'bg-gray-200 text-gray-800'; // Default
                            switch ($order->status) {
                                case 'pending':    $statusClass = 'bg-yellow-100 text-yellow-800 border border-yellow-300'; break;
                                case 'processing': $statusClass = 'bg-blue-100 text-blue-800 border border-blue-300'; break;
                                case 'completed':  $statusClass = 'bg-green-100 text-green-800 border border-green-300'; break;
                                case 'shipped':    $statusClass = 'bg-indigo-100 text-indigo-800 border border-indigo-300'; break;
                                case 'cancelled':  $statusClass = 'bg-red-100 text-red-800 border border-red-300'; break;
                            }
                        @endphp
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                            {{ ucfirst($order->status) }}
                        </span>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-sm font-semibold text-amber-700 hover:text-amber-900 hover:underline">
                            Lihat Detail &rarr;
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-lg shadow-md">
                <svg class="mx-auto h-12 w-12 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                <h3 class="mt-4 text-lg font-semibold text-stone-900">Belum Ada Pesanan</h3>
                <p class="mt-1 text-sm text-stone-500">Saat ada transaksi baru, pesanan akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    {{-- Link Paginasi dengan Desain Baru --}}
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
@endsection

@extends('admin.app')

@section('title', "Detail Pesanan #{$order->id}") {{-- Judul dinamis untuk tab browser --}}

@section('content')
    {{-- HEADER HALAMAN DENGAN NAVIGASI KEMBALI --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h1 class="text-3xl font-serif font-bold text-stone-800">Detail Pesanan #{{ $order->id }}</h1>
            <p class="mt-1 text-stone-600">Dipesan oleh {{ $order->user->name }} pada {{ $order->created_at->format('d F Y, H:i') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-white border border-stone-300 rounded-md font-semibold text-xs text-stone-700 uppercase tracking-widest shadow-sm hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            &larr; Kembali ke Daftar Pesanan
        </a>
    </div>

    {{-- NOTIFIKASI SUKSES SETELAH UPDATE STATUS --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- KOLOM KIRI: DAFTAR BARANG DAN TOTAL --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center border-b border-stone-200 pb-4 mb-4">
                    <svg class="w-6 h-6 mr-3 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    <h3 class="text-xl font-serif font-bold text-stone-800">Barang yang Dipesan</h3>
                </div>
                
                <div class="space-y-4">
                    {{-- Loop untuk setiap item produk --}}
                    @foreach($order->items as $item)
                    <div class="flex items-center space-x-4">
                        <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://placehold.co/100x100/f3f2ee/a18a62?text=Kopi' }}" alt="{{ $item->product->name ?? 'Produk Dihapus' }}" class="h-16 w-16 object-cover rounded-md">
                        <div class="flex-grow">
                            <p class="font-semibold text-stone-800">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                            <p class="text-sm text-stone-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-semibold text-stone-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
                
                {{-- Bagian Total --}}
                <div class="mt-6 pt-4 border-t border-stone-200 space-y-2">
                    <div class="flex justify-between text-stone-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-xl font-bold text-stone-900 mt-2 pt-2 border-t border-dashed">
                        <span>Total Pesanan</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: INFO PELANGGAN, PENGIRIMAN, & STATUS --}}
        <div class="space-y-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center border-b border-stone-200 pb-4 mb-4">
                    <svg class="w-6 h-6 mr-3 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <h3 class="text-xl font-serif font-bold text-stone-800">Info Pelanggan</h3>
                </div>
                <div class="space-y-1 text-stone-700">
                    <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center border-b border-stone-200 pb-4 mb-4">
                    <svg class="w-6 h-6 mr-3 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-xl font-serif font-bold text-stone-800">Pengiriman & Pembayaran</h3>
                </div>
                <div class="space-y-2 text-stone-700">
                     <p><strong>Alamat Kirim:</strong><br><span class="text-stone-600">{{ $order->shipping_address }}</span></p>
                    <p><strong>Metode Pembayaran:</strong> <span class="font-semibold">{{ $order->payment_method ?? 'Belum Ditentukan' }}</span></p>
                    <p><strong>Status Pembayaran:</strong> <span class="font-semibold">{{ ucfirst($order->payment_status) }}</span></p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center border-b border-stone-200 pb-4 mb-4">
                     <svg class="w-6 h-6 mr-3 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5M7 7l-3.5 3.5a9 9 0 1012.02-3.02M20 20v-5h-5"></path></svg>
                    <h3 class="text-xl font-serif font-bold text-stone-800">Update Status</h3>
                </div>
                <div class="mb-4">
                    <span class="text-stone-700">Status Saat Ini: </span>
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
                    <span class="px-3 py-1 text-sm font-bold rounded-full {{ $statusClass }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <label for="status" class="block text-sm font-medium text-stone-700">Ubah Status Menjadi:</label>
                    <select name="status" id="status" class="w-full mt-1 p-2 border border-stone-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        <option value="pending" @selected($order->status == 'pending')>Pending</option>
                        <option value="processing" @selected($order->status == 'processing')>Processing</option>
                        <option value="shipped" @selected($order->status == 'shipped')>Shipped</option>
                        <option value="completed" @selected($order->status == 'completed')>Completed</option>
                        <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                    </select>
                    <button type="submit" class="w-full mt-4 bg-stone-800 hover:bg-amber-900 text-white font-bold py-2 px-4 rounded-md transition-colors shadow-sm">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

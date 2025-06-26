@extends('layouts.app')

@section('content')
<div class="bg-stone-100 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-stone-800">Detail Pesanan #{{ $order->id }}</h1>
            <a href="{{ route('order.history') }}" class="text-yellow-900 hover:underline">&larr; Kembali ke Riwayat Pesanan</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-6 mb-6">
                <div>
                    <h3 class="font-bold mb-2">Info Pesanan</h3>
                    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d F Y') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <h3 class="font-bold mb-2">Alamat Pengiriman</h3>
                    <p>{{ $order->shipping_address }}</p>
                </div>
            </div>

            <h3 class="font-bold mb-4">Barang yang Dipesan</h3>
            <div class="space-y-4">
                @foreach ($order->items as $item)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-semibold">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                        <p class="text-sm text-stone-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="font-semibold">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
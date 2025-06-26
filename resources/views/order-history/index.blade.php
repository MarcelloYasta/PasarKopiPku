@extends('layouts.app')

@section('content')
<div class="bg-stone-100 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <h1 class="text-3xl font-bold font-serif text-center text-stone-800 mb-8">Riwayat Pesanan Anda</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            @forelse ($orders as $order)
                <div class="border-b border-stone-200 py-4 flex justify-between items-center">
                    <div>
                        <p class="font-bold">Pesanan #{{ $order->id }}</p>
                        <p class="text-sm text-stone-600">Tanggal: {{ $order->created_at->format('d F Y') }}</p>
                        <p class="text-sm text-stone-600">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        <span class="mt-2 inline-block px-2 py-1 text-xs font-semibold rounded-full bg-yellow-200 text-yellow-800">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div>
                        <a href="{{ route('order.show', $order->id) }}" class="bg-stone-800 text-white px-4 py-2 rounded-md hover:bg-yellow-900 transition text-sm">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-stone-600">Anda belum memiliki riwayat pesanan.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block text-yellow-900 font-bold hover:underline">Mulai Belanja &rarr;</a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
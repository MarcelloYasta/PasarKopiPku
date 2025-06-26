@extends('admin.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">&larr; Kembali ke Daftar Pesanan</a>
    </div>

    {{-- [SEMPURNA] Notifikasi untuk menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- KOLOM KIRI: DAFTAR BARANG --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold border-b pb-4">Barang yang Dipesan</h3>
                <table class="w-full mt-4 text-left">
                    <thead>
                        <tr>
                            <th class="py-2 px-2">Produk</th>
                            <th class="py-2 px-2 text-center">Jumlah</th>
                            <th class="py-2 px-2 text-right">Harga Satuan</th>
                            <th class="py-2 px-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="border-b">
                            <td class="py-4 px-2">{{ $item->product->name ?? 'Produk Dihapus' }}</td>
                            <td class="py-4 px-2 text-center">{{ $item->quantity }}</td>
                            <td class="py-4 px-2 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-4 px-2 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tr class="font-bold">
                            <td colspan="3" class="text-right py-4 px-2">Total Pesanan:</td>
                            <td class="text-right py-4 px-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- KOLOM KANAN: INFO PELANGGAN, PENGIRIMAN, & STATUS --}}
        <div>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold border-b pb-4 mb-4">Info Pelanggan</h3>
                <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
            </div>

            {{-- [SEMPURNA] Menampilkan info pengiriman dan pembayaran --}}
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold border-b pb-4 mb-4">Pengiriman & Pembayaran</h3>
                <p class="mb-2"><strong>Alamat Kirim:</strong><br>{{ $order->shipping_address }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                <p><strong>Status Pembayaran:</strong> {{ ucfirst($order->payment_status) }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold border-b pb-4 mb-4">Update Status Pesanan</h3>
                <div class="mb-4">
                    <span>Status Saat Ini: </span>
                    {{-- [SEMPURNA] Badge status dinamis --}}
                    @php
                        $statusClass = 'bg-gray-200 text-gray-800'; // Default
                        switch ($order->status) {
                            case 'pending': $statusClass = 'bg-yellow-200 text-yellow-800'; break;
                            case 'processing': $statusClass = 'bg-blue-200 text-blue-800'; break;
                            case 'completed': $statusClass = 'bg-green-200 text-green-800'; break;
                            case 'shipped': $statusClass = 'bg-indigo-200 text-indigo-800'; break;
                            case 'cancelled': $statusClass = 'bg-red-200 text-red-800'; break;
                        }
                    @endphp
                    <span class="px-3 py-1 text-sm font-bold rounded-full {{ $statusClass }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                {{-- [SEMPURNA] Form update status yang fungsional --}}
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <label for="status" class="block text-sm font-medium text-gray-700">Ubah Status Menjadi:</label>
                    <select name="status" id="status" class="w-full mt-1 p-2 border rounded-md shadow-sm">
                        <option value="pending" @selected($order->status == 'pending')>Pending</option>
                        <option value="processing" @selected($order->status == 'processing')>Processing</option>
                        <option value="shipped" @selected($order->status == 'shipped')>Shipped</option>
                        <option value="completed" @selected($order->status == 'completed')>Completed</option>
                        <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                    </select>
                    <button type="submit" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
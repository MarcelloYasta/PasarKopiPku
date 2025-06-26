@extends('admin.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manajemen Pesanan</h1>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2 px-4">ID Pesanan</th>
                    <th class="py-2 px-4">Nama Pelanggan</th>
                    <th class="py-2 px-4">Tanggal</th>
                    <th class="py-2 px-4">Total</th>
                    <th class="py-2 px-4 text-center">Status</th>
                    <th class="py-2 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4 px-4 font-medium">#{{ $order->id }}</td>
                        <td class="py-4 px-4">{{ $order->user->name }}</td>
                        <td class="py-4 px-4">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="py-4 px-4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="py-4 px-4 text-center">
                            {{-- [SEMPURNA] Warna badge status sekarang dinamis --}}
                            @php
                                $statusClass = '';
                                switch ($order->status) {
                                    case 'pending':
                                        $statusClass = 'bg-yellow-200 text-yellow-800';
                                        break;
                                    case 'processing':
                                        $statusClass = 'bg-blue-200 text-blue-800';
                                        break;
                                    case 'completed':
                                        $statusClass = 'bg-green-200 text-green-800';
                                        break;
                                    case 'shipped':
                                        $statusClass = 'bg-indigo-200 text-indigo-800';
                                        break;
                                    case 'cancelled':
                                        $statusClass = 'bg-red-200 text-red-800';
                                        break;
                                    default:
                                        $statusClass = 'bg-gray-200 text-gray-800';
                                }
                            @endphp
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            {{-- [SEMPURNA] Link Detail sekarang berfungsi --}}
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6">Belum ada data pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- [SEMPURNA] Menampilkan link untuk Paginasi --}}
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
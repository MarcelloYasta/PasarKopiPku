@extends('admin.app')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="space-y-6">
        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h1 class="text-3xl font-bold font-serif text-stone-800">Manajemen Produk</h1>
                <p class="mt-1 text-stone-600">Tambah, edit, atau hapus produk kopi Anda dari sini.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="mt-4 sm:mt-0 inline-flex items-center bg-yellow-900 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                <span>Tambah Produk Baru</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
                <p class="font-bold">Sukses</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabel Produk -->
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-stone-600">
                    <thead class="text-xs text-stone-700 uppercase bg-stone-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Produk</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Harga</th>
                            <th scope="col" class="px-6 py-3">Stok</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="bg-white border-b hover:bg-stone-50">
                                <th scope="row" class="px-6 py-4 font-medium text-stone-900 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <img class="w-12 h-12 rounded-md object-cover" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100/f3f2ee/a18a62?text=Kopi' }}" alt="{{ $product->name }}">
                                        <span>{{ $product->name }}</span>
                                    </div>
                                </th>
                                <td class="px-6 py-4">{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $product->stock }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="font-medium text-yellow-900 hover:underline">Edit</a>
                                        <span class="text-stone-300">|</span>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-stone-500">
                                    Belum ada data produk. Silakan tambah produk baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

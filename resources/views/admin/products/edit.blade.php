{{-- File: resources/views/admin/products/edit.blade.php --}}
@extends('admin.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="space-y-6 max-w-4xl mx-auto">
        <!-- Header Halaman -->
        <div>
            <h1 class="text-3xl font-bold font-serif text-stone-800">Edit Produk</h1>
            <p class="mt-1 text-stone-600">Perbarui detail untuk produk: <span class="font-semibold">{{ $product->name }}</span></p>
        </div>

        <!-- Form Edit Produk -->
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Metode untuk update --}}
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Produk -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-stone-700">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                               class="mt-1 block w-full px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-yellow-900 focus:border-yellow-900">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-stone-700">Kategori</label>
                        <select name="category_id" id="category_id" required
                                class="mt-1 block w-full px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-yellow-900 focus:border-yellow-900">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-stone-700">Harga</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required
                               class="mt-1 block w-full px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-yellow-900 focus:border-yellow-900">
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-stone-700">Stok</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required
                               class="mt-1 block w-full px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-yellow-900 focus:border-yellow-900">
                    </div>
                    
                    <!-- Gambar Produk -->
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                        <!-- Preview Gambar Saat Ini -->
                        <div>
                            <label class="block text-sm font-medium text-stone-700">Gambar Saat Ini</label>
                             @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-24 w-24 object-cover mt-1 rounded-md border border-stone-200">
                            @else
                                <div class="h-24 w-24 mt-1 flex items-center justify-center bg-stone-100 rounded-md text-stone-400 text-xs">
                                    Tidak ada gambar
                                </div>
                            @endif
                        </div>
                        <!-- Upload Gambar Baru -->
                        <div class="md:col-span-2">
                             <label for="image" class="block text-sm font-medium text-stone-700">Ganti Gambar (Opsional)</label>
                            <input type="file" name="image" id="image"
                                   class="mt-1 block w-full text-sm text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-100 file:text-yellow-900 hover:file:bg-yellow-200">
                        </div>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-stone-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="5"
                                  class="mt-1 block w-full px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-yellow-900 focus:border-yellow-900">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-8 pt-6 border-t border-stone-200 flex justify-end items-center space-x-4">
                    <a href="{{ route('admin.products.index') }}" class="text-stone-600 hover:text-stone-800">Batal</a>
                    <button type="submit" class="inline-flex items-center bg-yellow-900 hover:bg-yellow-800 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition-colors">
                        Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

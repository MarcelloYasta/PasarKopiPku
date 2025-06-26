@extends('admin.app')
@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Produk Baru</h1>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700">Nama Produk</label>
                    <input type="text" name="name" id="name" class="w-full mt-2 p-2 border rounded" required>
                </div>
                <div>
                    <label for="category_id" class="block text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id" class="w-full mt-2 p-2 border rounded" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="price" class="block text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" class="w-full mt-2 p-2 border rounded" required>
                </div>
                <div>
                    <label for="stock" class="block text-gray-700">Stok</label>
                    <input type="number" name="stock" id="stock" class="w-full mt-2 p-2 border rounded" required>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="5" class="w-full mt-2 p-2 border rounded" required></textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="image" class="block text-gray-700">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="w-full mt-2 p-2 border rounded">
                </div>
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Simpan Produk</button>
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 ml-4">Batal</a>
            </div>
        </form>
    </div>
@endsection
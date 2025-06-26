@extends('admin.app')
@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Produk: {{ $product->name }}</h1>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700">Nama Produk</label>
                    <input type="text" name="name" id="name" class="w-full mt-2 p-2 border rounded" value="{{ old('name', $product->name) }}" required>
                </div>
                <div>
                    <label for="category_id" class="block text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id" class="w-full mt-2 p-2 border rounded" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="price" class="block text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" class="w-full mt-2 p-2 border rounded" value="{{ old('price', $product->price) }}" required>
                </div>
                <div>
                    <label for="stock" class="block text-gray-700">Stok</label>
                    <input type="number" name="stock" id="stock" class="w-full mt-2 p-2 border rounded" value="{{ old('stock', $product->stock) }}" required>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="5" class="w-full mt-2 p-2 border rounded" required>{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="image" class="block text-gray-700">Ganti Gambar Produk (Opsional)</label>
                    <input type="file" name="image" id="image" class="w-full mt-2 p-2 border rounded">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-24 w-auto mt-4">
                    @endif
                </div>
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Perbarui Produk</button>
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 ml-4">Batal</a>
            </div>
        </form>
    </div>
@endsection
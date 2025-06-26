@extends('layouts.app')

@section('content')
    <section class="bg-stone-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="font-serif text-5xl font-extrabold tracking-tight">Koleksi Kopi Kami</h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-stone-300">Temukan biji kopi favorit Anda dari seluruh penjuru Nusantara, disangrai dengan penuh dedikasi.</p>
        </div>
    </section>

    <section class="py-16 bg-stone-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            {{-- [SEMPURNA] Notifikasi setelah berhasil menambah ke keranjang --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-8" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <aside class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md h-fit sticky top-24">
                    <h2 class="font-serif text-2xl font-bold mb-4 border-b border-stone-200 pb-3">Kategori</h2>
                    <ul class="space-y-3">
                        <li>
                            {{-- [SEMPURNA] Link ini mengarah ke halaman produk tanpa filter --}}
                            <a href="{{ route('products.index') }}" class="block font-semibold text-yellow-900 transition hover:underline">
                                Semua Produk
                            </a>
                        </li>
                        {{-- [SEMPURNA] Loop untuk menampilkan kategori dari database --}}
                        @foreach ($categories as $category)
                            <li>
                                {{-- [SEMPURNA] Link ini memfilter produk berdasarkan slug kategori --}}
                                <a href="{{ route('products.index', ['kategori' => $category->slug]) }}" class="block font-semibold text-stone-800 hover:text-yellow-900 transition">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                <main class="lg:col-span-3">
                    {{-- [SEMPURNA] Menghapus data statis, diganti data dari controller --}}
                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                            @foreach ($products as $product)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden group relative transition-all duration-300 hover:shadow-xl hover:-translate-y-2 flex flex-col">
                                    <div class="relative">
                                        <a href="#"> {{-- Link ke detail produk bisa dibuat nanti --}}
                                            <span class="absolute top-4 left-4 bg-yellow-900 text-white text-xs font-bold px-3 py-1 rounded-full z-10">{{ $product->category->name }}</span>
                                            {{-- [SEMPURNA] Menampilkan gambar dari database --}}
                                            <img class="h-64 w-full object-cover transform group-hover:scale-110 transition-transform duration-500" 
                                                 src="{{ asset('storage/' . ($product->image ?? 'placeholder.jpg')) }}" 
                                                 alt="[Gambar {{ $product->name }}]">
                                        </a>
                                    </div>
                                    <div class="p-6 flex flex-col flex-grow">
                                        <h3 class="font-serif text-xl font-bold text-stone-900 flex-grow">
                                            <a href="#" class="hover:text-yellow-900">{{ $product->name }}</a>
                                        </h3>
                                        <p class="mt-4 text-lg font-semibold text-stone-800">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <div class="mt-4 pt-4 border-t border-stone-100">
                                            {{-- [SEMPURNA] Tombol "Tambah ke Keranjang" yang Fungsional --}}
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full text-center inline-block bg-stone-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-yellow-900 transition-colors shadow-sm hover:shadow-md">
                                                    Tambah ke Keranjang
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="bg-white p-12 rounded-lg shadow-md text-center">
                            <p class="text-gray-500 text-xl">Mohon maaf, tidak ada produk yang ditemukan untuk kategori ini.</p>
                            <a href="{{ route('products.index') }}" class="mt-4 inline-block text-yellow-900 font-bold hover:underline">Lihat Semua Produk &rarr;</a>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </section>
@endsection
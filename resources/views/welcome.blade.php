{{-- File: resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('content')

    <!-- Bagian 1: Hero Section -->
    <section class="relative h-screen bg-cover bg-fixed bg-center" style="background-image: url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=2942&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-stone-900/70 to-transparent"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
            <h1 class="font-serif text-5xl md:text-7xl font-bold leading-tight drop-shadow-lg">Aroma Khas Pekanbaru, Kualitas Nusantara</h1>
            <p class="mt-4 text-lg md:text-xl max-w-2xl drop-shadow-md">Setiap biji kopi kami adalah cerita tentang dedikasi dan cita rasa yang tak terlupakan.</p>
            <div class="mt-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('products.index') }}" class="bg-yellow-900 hover:bg-yellow-800 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                    Jelajahi Koleksi Kami
                </a>
                <a href="#tentang" class="bg-transparent border-2 border-white hover:bg-white hover:text-black text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                    Cerita Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Bagian 2: Keunggulan / Value Proposition -->
    <section class="py-20 bg-stone-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                <div class="p-4">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-12v4m-2-2h4m5 6v4m-2-2h4M4 11h16"></path></svg>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-stone-800">Biji Kopi Premium</h3>
                    <p class="mt-2 text-gray-600">Dipilih langsung dari perkebunan terbaik di Riau dan sekitarnya.</p>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10s5 2 5 2a8 8 0 015.657 8.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A5 5 0 0012 19c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5c0 .246.035.486.1.721"></path></svg>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-stone-800">Freshly Roasted</h3>
                    <p class="mt-2 text-gray-600">Disangrai oleh para ahli untuk mengeluarkan potensi rasa maksimal.</p>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-stone-800">Dukungan Petani Lokal</h3>
                    <p class="mt-2 text-gray-600">Setiap pembelian Anda turut mensejahterakan petani kopi daerah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian 3: Produk Unggulan dengan Desain Baru -->
    <section id="produk" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="font-serif text-4xl font-bold text-stone-900">Koleksi Terlaris</h2>
            <p class="mt-2 text-gray-600">Pilihan favorit dari para penikmat kopi sejati.</p>
        </div>
        
        {{-- [SEMPURNA] Menampilkan produk dinamis dari controller --}}
        @if ($featuredProducts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group relative transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 flex flex-col">
                        <div class="relative">
                            {{-- Nanti link ini bisa diarahkan ke halaman detail produk --}}
                            <a href="#">
                                <span class="absolute top-4 left-4 bg-yellow-900 text-white text-xs font-bold px-3 py-1 rounded-full z-10">{{ $product->category->name }}</span>
                                <img class="h-80 w-full object-cover transform group-hover:scale-110 transition-transform duration-500" 
                                     src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400/f3f2ee/a18a62?text=Kopi' }}" 
                                     alt="[Gambar {{ $product->name }}]">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-serif text-xl font-bold text-stone-900 flex-grow">
                                <a href="#" class="hover:text-yellow-900">{{ $product->name }}</a>
                            </h3>
                            <p class="mt-4 text-lg font-semibold text-stone-800">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            
                            {{-- [SEMPURNA] Form "Tambah ke Keranjang" yang fungsional --}}
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="w-full text-center inline-block bg-stone-800 text-white font-bold py-2 px-4 rounded hover:bg-yellow-900 transition-colors">
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500">
                <p>Produk unggulan akan segera hadir.</p>
            </div>
        @endif
        
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="text-yellow-900 font-bold hover:underline text-lg">
                Lihat Semua Koleksi &rarr;
            </a>
        </div>
    </div>
</section>

    <!-- Bagian 4: Proses Kami (Storytelling) -->
    <section id="tentang" class="py-20 bg-stone-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-serif text-4xl font-bold">Dari Biji Hingga Cangkir Anda</h2>
                <p class="mt-2 text-stone-400">Kami menjaga setiap langkah dengan penuh perhatian.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-4 text-center max-w-5xl mx-auto">
                <div class="p-4">
                    <p class="font-serif text-7xl text-yellow-600">01.</p>
                    <h3 class="font-serif text-2xl font-bold mt-2">Seleksi Biji Terbaik</h3>
                    <p class="mt-2 text-stone-400">Bekerja sama dengan petani lokal untuk mendapatkan biji kopi kualitas tertinggi.</p>
                </div>
                <div class="p-4">
                    <p class="font-serif text-7xl text-yellow-600">02.</p>
                    <h3 class="font-serif text-2xl font-bold mt-2">Proses Roasting Ahli</h3>
                    <p class="mt-2 text-stone-400">Tiap batch disangrai dengan presisi untuk menonjolkan profil rasa yang unik.</p>
                </div>
                <div class="p-4">
                    <p class="font-serif text-7xl text-yellow-600">03.</p>
                    <h3 class="font-serif text-2xl font-bold mt-2">Pengemasan Cepat</h3>
                    <p class="mt-2 text-stone-400">Dikemas sesaat setelah di-roasting untuk menjaga kesegaran maksimal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian 5: Testimoni Pelanggan -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-serif text-4xl font-bold text-stone-900">Apa Kata Mereka?</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-stone-50 p-8 rounded-lg">
                    <p class="text-gray-600 italic">"Kopi Robusta-nya benar-benar nendang! Pengiriman juga cepat. Pasti akan pesan lagi di sini."</p>
                    <p class="font-bold text-stone-800 text-right mt-4">- Budi, Pekanbaru</p>
                </div>
                <div class="bg-stone-50 p-8 rounded-lg">
                    <p class="text-gray-600 italic">"Akhirnya nemu kopi Liberika yang otentik. Rasanya unik dan beda dari yang lain. Recommended!"</p>
                    <p class="font-bold text-stone-800 text-right mt-4">- Anita, Jakarta</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Bagian 6: Newsletter / Call to Action -->
    <section class="bg-yellow-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="font-serif text-3xl font-bold text-yellow-900">Dapatkan Info & Penawaran Spesial</h2>
            <p class="mt-2 text-yellow-800 max-w-xl mx-auto">Jadilah yang pertama tahu tentang produk baru, diskon, dan cerita kopi eksklusif dari kami.</p>
            <form action="#" method="POST" class="mt-8 max-w-md mx-auto flex">
                <input type="email" name="email" placeholder="Masukkan alamat email Anda" class="w-full px-4 py-3 rounded-1-md border-gray-300 focus:ring-yellow-800 focus:border-yellow-800" required>
                <button type="submit" class="bg-stone-800 hover:bg-yellow-900 text-white font-bold px-6 py-3 rounded-r-md">Subscribe</button>
            </form>
        </div>
    </section>

@endsection

{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pasar Kopi Pekanbaru') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    {{-- Aset CSS dan JS yang dikompilasi oleh Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-stone-50 text-stone-800">
    
    {{-- ====================================================== --}}
    {{-- HEADER WEBSITE (DENGAN PENYEMPURNAAN RESPONSIVE)     --}}
    {{-- ====================================================== --}}
    <header class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <nav x-data="{ open: false }" class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
            <img class="h-12 w-auto" src="{{ asset('image/logo.png') }}" alt="Logo Pasar Kopi Pekanbaru">
                <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-bold font-serif text-gray-700 tracking-wider flex-shrink-0">
                        Pasar Kopi Pekanbaru
                </a>

                <div class="hidden lg:flex items-center space-x-10 mx-auto">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-yellow-900 transition font-medium">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-yellow-900 transition font-medium">Produk</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-yellow-900 transition font-medium">Keranjang</a>
                </div>

                <div class="hidden md:flex items-center space-x-4 flex-shrink-0">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-yellow-900">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-stone-800 hover:bg-yellow-900 px-5 py-2 rounded-full transition shadow">Daftar</a>
                    @else
                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5" x-cloak>
                                @if(Auth::user()->is_admin ?? false)
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-stone-100">Panel Admin</a>
                                @endif
                                <a href="{{ route('order.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-stone-100">Riwayat Pesanan</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-stone-100">
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <div class="md:hidden ml-4">
                    <button @click="open = !open" class="text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>

            <div x-show="open" @click.away="open = false" class="md:hidden pb-4" x-cloak>
                <a href="{{ route('home') }}" class="block py-2 text-base hover:bg-stone-100 rounded">Beranda</a>
                <a href="{{ route('products.index') }}" class="block py-2 text-base hover:bg-stone-100 rounded">Produk</a>
                <a href="{{ route('cart.index') }}" class="block py-2 text-base hover:bg-stone-100 rounded">Keranjang</a>
                <hr class="my-2">
                @guest
                    <a href="{{ route('login') }}" class="block py-2 text-base hover:bg-stone-100 rounded">Masuk</a>
                    <a href="{{ route('register') }}" class="block py-2 text-base hover:bg-stone-100 rounded">Daftar</a>
                @else
                    <div class="py-2 font-semibold">{{ Auth::user()->name }}</div>
                    @if(Auth::user()->is_admin ?? false)
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 text-base hover:bg-stone-100 rounded">Panel Admin</a>
                    @endif
                    <a href="{{ route('order.history') }}" class="block py-2 text-base hover:bg-stone-100 rounded">Riwayat Pesanan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block py-2 text-base hover:bg-stone-100 rounded">Logout</button>
                    </form>
                @endguest
            </div>
        </nav>
    </header>

    {{-- KONTEN UTAMA HALAMAN --}}
    <main>
        @yield('content')
    </main>

    {{-- ====================================================== --}}
    {{-- FOOTER WEBSITE (DENGAN PENYEMPURNAAN RESPONSIVE)     --}}
    {{-- ====================================================== --}}
    <footer class="bg-stone-900 text-white">
        <div class="max-w-screen-xl mx-auto py-12 lg:py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                <div class="col-span-2 lg:col-span-1">
                    <h3 class="font-serif text-xl font-bold">Pasar Kopi Pekanbaru</h3>
                    <p class="mt-4 text-sm text-stone-400">Menyajikan biji kopi pilihan langsung dari petani Riau untuk Anda nikmati.</p>
                </div>
                <div>
                    <h3 class="font-bold uppercase tracking-wider text-sm text-stone-400">Navigasi</h3>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="#" class="text-stone-300 hover:text-white hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="text-stone-300 hover:text-white hover:underline">Cara Pesan</a></li>
                        <li><a href="#" class="text-stone-300 hover:text-white hover:underline">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold uppercase tracking-wider text-sm text-stone-400">Layanan</h3>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="#" class="text-stone-300 hover:text-white hover:underline">Langganan Kopi</a></li>
                        <li><a href="#" class="text-stone-300 hover:text-white hover:underline">Kopi untuk Kantor</a></li>
                        <li><a href="#" class="text-stone-300 hover:text-white hover:underline">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-span-2 lg:col-span-1">
                    <h3 class="font-bold uppercase tracking-wider text-sm text-stone-400">Ikuti Kami</h3>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-stone-400 hover:text-white" aria-label="Facebook">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="text-stone-400 hover:text-white" aria-label="Twitter">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                         <a href="#" class="text-stone-400 hover:text-white" aria-label="Instagram">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.343 2.465c.636-.247 1.363-.416 2.427-.465C9.793 2.013 10.147 2 12.315 2zm0 1.623a10.72 10.72 0 00-3.774.057c-1.02.046-1.634.2-2.174.403a3.272 3.272 0 00-1.17 1.17c-.203.54-.357 1.153-.403 2.174-.057 1.256-.057 3.27.001 4.524.057 1.256.057 3.27-.001 4.524-.046 1.02-.2 1.634-.403 2.174a3.272 3.272 0 001.17 1.17c.54.203 1.153.357 2.174.403 1.256.057 3.27.057 4.524-.001 1.256-.057 3.27-.057 4.524.001 1.02.046 1.634.2 2.174.403a3.272 3.272 0 001.17-1.17c.203-.54.357-1.153.403-2.174.057-1.256.057-3.27-.001-4.524-.057-1.256-.057-3.27.001-4.524.046-1.02.2-1.634.403-2.174a3.272 3.272 0 00-1.17-1.17c-.54-.203-1.153-.357-2.174-.403-1.256-.057-3.27-.057-4.524.001z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-stone-800 text-center text-sm text-stone-500">
                &copy; {{ date('Y') }} AIO Group.
            </div>
        </div>
    </footer>

</body>
</html>

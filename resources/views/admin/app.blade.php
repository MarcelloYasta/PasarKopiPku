{{-- File: resources/views/admin/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>
    
    {{-- Memuat Font yang Sama dengan Frontend --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-stone-100">
        
        <!-- ================================== -->
        <!-- SIDEBAR NAVIGASI (DESAIN BARU)     -->
        <!-- ================================== -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-64 bg-stone-900 text-stone-300 transform transition-transform duration-300 ease-in-out z-30 lg:translate-x-0 lg:static lg:inset-0">
            <!-- Logo & Nama Panel -->
            <div class="p-6 text-center">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold font-serif text-amber-500 tracking-wider">
                    Admin
                </a>
                <p class="text-xs text-stone-500">Pasar Kopi Pekanbaru</p>
            </div>
            
            <!-- Menu Navigasi Utama -->
            <nav class="mt-4 px-4">
                {{-- Helper untuk Nav Link agar bisa menandai halaman aktif --}}
                @php
                    function nav_link($route, $icon, $label) {
                        // [SEMPURNA] Menambahkan '*' agar link tetap aktif di halaman child (create, edit, dll)
                        $isActive = request()->routeIs($route . '*');
                        $class = $isActive 
                            ? 'flex items-center px-4 py-2.5 text-amber-500 bg-stone-800 rounded-lg' 
                            : 'flex items-center px-4 py-2.5 text-stone-300 hover:bg-stone-800 hover:text-amber-500 rounded-lg transition-colors';
                        
                        if (!Route::has($route)) {
                            return "<div class='flex items-center px-4 py-2.5 text-stone-500 cursor-not-allowed'><svg class='w-5 h-5 mr-3' fill='none' stroke='currentColor' viewBox='0 0 24 24'>{$icon}</svg><span>{$label}</span></div>";
                        }

                        return '<a href="'.route($route).'" class="'.$class.'"><svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">'.$icon.'</svg><span>'.$label.'</span></a>';
                    }
                @endphp

                <ul class="space-y-2">
                    <li>{!! nav_link('admin.dashboard', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>', 'Dashboard') !!}</li>
                    <li>{!! nav_link('admin.products.index', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>', 'Produk') !!}</li>
                    <li>{!! nav_link('admin.orders.index', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>', 'Pesanan') !!}</li>
                    {{-- [SEMPURNA] Link Pengguna sekarang sudah diaktifkan --}}
                    <li>{!! nav_link('admin.users.index', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2"></path>', 'Pengguna') !!}</li>
                </ul>

                <hr class="my-4 border-stone-700">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center px-4 py-2.5 text-stone-300 hover:bg-stone-800 hover:text-amber-500 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span>Lihat Situs</span>
                </a>
            </nav>

            <!-- User Info & Logout di bawah Sidebar -->
             <div class="p-4 absolute bottom-0 left-0 w-full border-t border-stone-800 bg-stone-900">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="inline-block h-9 w-9 rounded-full bg-amber-900 text-white text-center font-bold leading-9">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs text-stone-400 hover:underline focus:outline-none">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Latar belakang gelap untuk mobile saat sidebar terbuka -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black opacity-50 z-20 lg:hidden" x-cloak></div>

        <!-- ================================== -->
        <!-- AREA KONTEN UTAMA                  -->
        <!-- ================================== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header Konten (termasuk tombol hamburger) -->
            <header class="flex justify-between items-center p-4 bg-white border-b border-stone-200">
                <!-- Tombol untuk membuka sidebar di mobile -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-stone-500 focus:outline-none lg:hidden">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <div class="flex-grow">
                    <!-- Judul Halaman dinamis -->
                    <h1 class="text-xl font-semibold text-stone-700">@yield('title', 'Dashboard')</h1>
                </div>
                 <div class="flex items-center">
                     {{-- Mungkin ada tombol aksi lain di header kanan --}}
                 </div>
            </header>

            <!-- Konten Utama yang bisa di-scroll -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-stone-100 p-4 sm:p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

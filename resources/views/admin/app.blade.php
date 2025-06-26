<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen bg-gray-200">
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <div class="p-6 text-2xl font-bold font-serif text-amber-500">
                <a href="{{ route('admin.dashboard') }}">Admin Kopi</a>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-6 hover:bg-gray-700">Dasbor</a>
                <a href="{{ route('admin.products.index') }}" class="block py-2.5 px-6 hover:bg-gray-700">Produk</a>
                <a href="{{ route('admin.orders.index') }}" class="block py-2.5 px-6 hover:bg-gray-700">Pesanan</a>
                <a href="#" class="block py-2.5 px-6 hover:bg-gray-700">Pengguna</a>
                <hr class="my-2 border-gray-700">
                <a href="{{ route('home') }}" target="_blank" class="block py-2.5 px-6 hover:bg-gray-700">Lihat Situs</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-end items-center p-4 bg-white border-b">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-red-700">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
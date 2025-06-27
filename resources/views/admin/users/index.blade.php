@extends('admin.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h1 class="text-3xl font-serif font-bold text-stone-800">Manajemen Pengguna</h1>
            <p class="mt-1 text-stone-600">Daftar semua pengguna yang terdaftar di sistem.</p>
        </div>
    </div>

    {{-- [DESAIN BARU] DAFTAR PENGGUNA SEBAGAI KARTU --}}
    <div class="space-y-4">
        @forelse($users as $user)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex items-center space-x-4">
                {{-- Avatar Inisial --}}
                <div class="flex-shrink-0">
                    <span class="inline-block h-12 w-12 rounded-full bg-stone-200 text-stone-600 text-center font-bold leading-12 text-xl">
                        {{ substr($user->name, 0, 1) }}
                    </span>
                </div>

                {{-- Info Pengguna --}}
                <div class="flex-grow">
                    <p class="font-bold text-stone-800">{{ $user->name }}</p>
                    <p class="text-sm text-stone-500">{{ $user->email }}</p>
                    <p class="text-xs text-stone-400 mt-1">Bergabung: {{ $user->created_at->format('d F Y') }}</p>
                </div>

                {{-- Peran (Role) --}}
                <div class="flex-shrink-0">
                    @if($user->is_admin)
                        <div class="flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 border border-amber-300">
                             <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Admin
                        </div>
                    @else
                        <div class="flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-800 border border-sky-300">
                           <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Pengunjung
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-lg shadow-md">
                <svg class="mx-auto h-12 w-12 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2"></path></svg>
                <h3 class="mt-4 text-lg font-semibold text-stone-900">Belum Ada Pengguna</h3>
                <p class="mt-1 text-sm text-stone-500">Saat ada pengguna baru yang mendaftar, mereka akan muncul di sini.</p>
            </div>
        @endforelse
    </div>
    
    {{-- Link Paginasi --}}
    <div class="mt-6">
        {{-- Jika Anda menggunakan paginasi di UserController, uncomment baris ini --}}
        {{-- {{ $users->links() }} --}}
    </div>
@endsection

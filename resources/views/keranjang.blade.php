{{-- File: resources/views/cart/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="bg-stone-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold font-serif text-center text-stone-800 mb-8">Keranjang Belanja Anda</h1>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Logika untuk menampilkan keranjang jika ada isinya, atau pesan jika kosong --}}
            @if(session('cart') && count(session('cart')) > 0)
                <div class="flex flex-col lg:flex-row gap-8">
                    
                    <!-- ================================== -->
                    <!-- KOLOM KIRI: DAFTAR ITEM          -->
                    <!-- ================================== -->
                    <div class="lg:w-2/3">
                        <div class="bg-white shadow-md rounded-lg divide-y divide-stone-200">
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity']; @endphp
                                <div class="flex items-center p-4 space-x-4">
                                    <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://via.placeholder.com/150/f3f2ee/a18a62?text=Kopi' }}" class="h-24 w-24 object-cover rounded-md" alt="{{ $details['name'] }}">
                                    
                                    <div class="flex-grow">
                                        <a href="#" class="font-bold text-lg hover:text-yellow-900">{{ $details['name'] }}</a>
                                        <p class="text-stone-600">Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="mt-1">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold p-0 bg-transparent border-none">Hapus</button>
                                        </form>
                                    </div>

                                    <div class="flex flex-col items-end space-y-2">
                                       <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <label for="quantity{{$id}}" class="sr-only">Jumlah</label>
                                            <input type="number" id="quantity{{$id}}" name="quantity" value="{{ $details['quantity'] }}" class="w-16 text-center border-gray-300 rounded-md shadow-sm" min="1">
                                            <button type="submit" class="ml-2 bg-stone-200 hover:bg-stone-300 px-2 py-1 rounded-md text-xs text-stone-700 font-semibold">OK</button>
                                        </form>
                                        <p class="font-semibold text-lg">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- ================================== -->
                    <!-- KOLOM KANAN: RINGKASAN & CHECKOUT -->
                    <!-- ================================== -->
                    <div class="lg:w-1/3">
                        <div class="bg-white shadow-md rounded-lg p-6 border sticky top-24">
                            <h2 class="text-2xl font-bold font-serif mb-4 border-b border-stone-200 pb-3">Ringkasan Pesanan</h2>
                            <div class="space-y-2 text-stone-700">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                 <div class="flex justify-between">
                                    <span>Ongkos Kirim</span>
                                    <span class="font-semibold text-sm">Akan dihitung</span>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="flex justify-between text-lg font-bold text-stone-900">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-stone-500 text-xs mt-2 mb-6">Pajak sudah termasuk jika berlaku.</p>
                            <a href="{{ route('checkout.index') }}" class="w-full block text-center bg-stone-800 text-white font-bold py-3 px-4 rounded-lg hover:bg-yellow-900 transition-colors shadow-sm hover:shadow-md">
                                Lanjutkan ke Checkout
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-lg shadow-md">
                    <svg class="mx-auto h-12 w-12 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-stone-900">Keranjang Anda Kosong</h3>
                    <p class="mt-1 text-sm text-stone-500">Ayo temukan kopi favorit Anda di koleksi kami!</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md bg-stone-800 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-900 transition-colors">
                            Mulai Belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

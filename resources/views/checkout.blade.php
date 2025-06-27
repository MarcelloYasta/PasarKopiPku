@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="py-12 bg-stone-100">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif text-center mb-10 text-stone-800">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- [SEMPURNA] KOLOM KIRI: FORM ALAMAT DAN PEMBAYARAN --}}
                <div class="space-y-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold mb-4 text-stone-800">1. Alamat Pengiriman</h3>
                        <div>
                            <label for="shipping_address" class="block mb-2 font-medium text-stone-700">Alamat Lengkap</label>
                            <textarea name="shipping_address" id="shipping_address" rows="5" class="w-full border-stone-300 rounded-md p-2 shadow-sm focus:border-yellow-800 focus:ring-yellow-800" required placeholder="Contoh: Jl. Sudirman No. 123, Kel. Suka Maju, Kec. Tampan, Kota Pekanbaru, Riau, 28292">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold mb-4 text-stone-800">2. Metode Pembayaran</h3>
                        <div class="space-y-4">
                            {{-- Opsi 1: Transfer Bank --}}
                            <label class="flex items-start p-4 border rounded-lg cursor-pointer has-[:checked]:bg-yellow-50 has-[:checked]:border-yellow-800 transition-all">
                                <input type="radio" name="payment_method" value="Bank Transfer" class="mt-1 text-yellow-900 focus:ring-yellow-800" checked>
                                <div class="ml-4">
                                    <p class="font-semibold text-stone-800">Transfer Bank (BCA)</p>
                                    <p class="text-sm text-stone-600">Lakukan pembayaran ke No. Rekening <strong>123-456-7890</strong> a/n Pasar Kopi Pekanbaru.</p>
                                </div>
                            </label>
                            {{-- Opsi 2: E-Wallet --}}
                            <label class="flex items-start p-4 border rounded-lg cursor-pointer has-[:checked]:bg-yellow-50 has-[:checked]:border-yellow-800 transition-all">
                                <input type="radio" name="payment_method" value="GoPay" class="mt-1 text-yellow-900 focus:ring-yellow-800">
                                <div class="ml-4">
                                    <p class="font-semibold text-stone-800">E-Wallet (GoPay)</p>
                                    <p class="text-sm text-stone-600">Lakukan pembayaran ke nomor GoPay <strong>0812-3456-7890</strong>.</p>
                                </div>
                            </label>
                            {{-- Opsi 3: COD --}}
                            <label class="flex items-start p-4 border rounded-lg cursor-pointer has-[:checked]:bg-yellow-50 has-[:checked]:border-yellow-800 transition-all">
                                <input type="radio" name="payment_method" value="COD" class="mt-1 text-yellow-900 focus:ring-yellow-800">
                                <div class="ml-4">
                                    <p class="font-semibold text-stone-800">Bayar di Tempat (COD)</p>
                                    <p class="text-sm text-stone-600">Siapkan uang pas saat kurir kami tiba.</p>
                                </div>
                            </label>
                            @error('payment_method')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: RINGKASAN & TOMBOL BUAT PESANAN --}}
                <div class="bg-white p-6 rounded-lg shadow-sm h-fit sticky top-24">
                    <h3 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-2 border-b pb-4 mb-4">
                        <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between"><span>Ongkos Kirim</span><span>Rp 15.000</span></div>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2">
                        <span>Total Akhir</span>
                        <span>Rp {{ number_format($total + 15000, 0, ',', '.') }}</span>
                    </div>
                    <button type="submit" class="w-full mt-6 bg-stone-800 hover:bg-yellow-900 text-white font-bold py-3 rounded-lg transition-colors shadow">
                        Buat Pesanan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection

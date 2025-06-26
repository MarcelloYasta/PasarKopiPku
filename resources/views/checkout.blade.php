@extends('layouts.app')
@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif text-center mb-10 text-stone-800">Checkout</h1>
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold mb-4">Alamat Pengiriman</h3>
                    <div class="mb-4">
                        <label for="shipping_address" class="block mb-2">Alamat Lengkap</label>
                        <textarea name="shipping_address" id="shipping_address" rows="5" class="w-full border rounded-md p-2" required></textarea>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h3>
                    <div class="flex justify-between border-b pb-2 mb-2"><span>Subtotal</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between border-b pb-2 mb-2"><span>Ongkir</span><span>Rp 15.000</span></div>
                    <div class="flex justify-between font-bold text-lg pt-2"><span>Total Akhir</span><span>Rp {{ number_format($total + 15000, 0, ',', '.') }}</span></div>
                    <button type="submit" class="w-full mt-6 bg-stone-800 hover:bg-yellow-900 text-white font-bold py-3 rounded transition shadow">Buat Pesanan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
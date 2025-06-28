<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda kosong untuk melakukan checkout!');
        }
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return view('checkout', compact('total'));
    }

    /**
     * Memproses pesanan dari halaman checkout.
     */
    public function store(Request $request)
    {
        // [SEMPURNA] Validasi sekarang mencakup metode pembayaran dan bukti bayar kondisional
        $request->validate([
            'shipping_address' => 'required|string|max:1000',
            'payment_method' => 'required|string|in:Bank Transfer,GoPay,COD',
            // 'payment_proof' wajib diisi jika metode pembayaran BUKAN COD
            'payment_proof' => 'required_if:payment_method,Bank Transfer,GoPay|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda kosong!');
        }
        
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        $total += 15000; // Tambah Ongkos Kirim

        // [SEMPURNA] Logika untuk menangani upload file bukti pembayaran
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Menggunakan transaksi database untuk memastikan semua operasi berhasil
        DB::beginTransaction();
        try {
            // 1. Simpan data ke tabel orders, termasuk metode dan bukti bayar
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                // Jika bukan COD, anggap sudah bayar (menunggu verifikasi). Jika COD, tetap unpaid.
                'payment_status' => ($request->payment_method == 'COD') ? 'unpaid' : 'paid', 
                'payment_proof' => $paymentProofPath, // Menyimpan path file bukti bayar
            ]);

            // 2. Simpan setiap item di keranjang ke tabel order_items
            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
                // Kurangi stok produk
                $product = Product::find($id);
                if ($product) {
                    $product->stock -= $details['quantity'];
                    $product->save();
                }
            }

            // Jika semua berhasil, konfirmasi transaksi
            DB::commit();
        } catch (\Exception $e) {
            // Jika ada error, batalkan semua operasi
            DB::rollBack();
            // Log error untuk debugging:
            // \Log::error('Checkout Error: '.$e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }

        // 3. Kosongkan keranjang setelah checkout berhasil
        session()->forget('cart');

        // 4. Arahkan ke halaman riwayat pesanan dengan pesan sukses
        return redirect()->route('order.history')->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }
}

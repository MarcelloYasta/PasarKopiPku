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
    public function index()
    {
        $cart = session()->get('cart', []);
        if(count($cart) == 0) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda kosong!');
        }
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return view('checkout', compact('total'));
    }

    public function store(Request $request)
    {
        $request->validate(['shipping_address' => 'required|string|max:1000']);
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        $total += 15000; // Tambah Ongkir

        DB::beginTransaction();
        try {
            // 1. Simpan data ke tabel orders
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'status' => 'pending',
                'payment_status' => 'unpaid',
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
                $product->stock -= $details['quantity'];
                $product->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }

        // 3. Kosongkan keranjang session
        session()->forget('cart');

        // 4. Arahkan ke halaman "Terima Kasih" atau riwayat pesanan
        return redirect()->route('home')->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Method ini menampilkan halaman keranjang belanja.
     * Inilah yang hilang dari file Anda.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('keranjang', compact('cart', 'total'));
    }

    /**
     * Method ini menambahkan produk ke keranjang.
     */
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Method ini mengubah jumlah barang di keranjang.
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            if ($request->quantity > 0) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                return back()->with('success', 'Jumlah barang berhasil diperbarui!');
            }
        }
        return back()->with('error', 'Gagal memperbarui jumlah barang.');
    }

    /**
     * Method ini menghapus barang dari keranjang.
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
        }
        return back()->with('error', 'Gagal menghapus produk.');
    }
}
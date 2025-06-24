<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data keranjang belanja dummy. Nantinya, ini akan diambil dari session atau database.
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Kopi Robusta Gayo',
                'price' => 85000,
                'quantity' => 2,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=Kopi+Robusta'
            ],
            [
                'id' => 3,
                'name' => 'Kopi Liberika Riau',
                'price' => 95000,
                'quantity' => 1,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=Kopi+Liberika'
            ],
        ];

        // Menghitung subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Mengirim data ke view 'keranjang'
        return view('keranjang', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal
        ]);
    }
}

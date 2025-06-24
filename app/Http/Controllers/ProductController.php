<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data produk dummy. Nantinya, Anda bisa mengambil ini dari database.
        $products = [
            [
                'id' => 1,
                'name' => 'Kopi Robusta Gayo',
                'description' => 'Biji kopi robusta pilihan dari dataran tinggi Gayo, Aceh. Memiliki cita rasa pahit yang khas dan kuat.',
                'price' => 85000,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=Kopi+Robusta'
            ],
            [
                'id' => 2,
                'name' => 'Kopi Arabika Toraja',
                'description' => 'Kopi arabika dari Toraja dengan keasaman seimbang dan sentuhan rasa rempah yang eksotis.',
                'price' => 120000,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=Kopi+Arabika'
            ],
            [
                'id' => 3,
                'name' => 'Kopi Liberika Riau',
                'description' => 'Jenis kopi langka dari Riau dengan aroma nangka yang unik dan rasa yang berani.',
                'price' => 95000,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=Kopi+Liberika'
            ],
            [
                'id' => 4,
                'name' => 'Kopi Excelsa Jawa',
                'description' => 'Kopi excelsa dari perkebunan di Jawa, menawarkan profil rasa yang kompleks dan berbeda.',
                'price' => 90000,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=Kopi+Excelsa'
            ],
            [
                'id' => 5,
                'name' => 'House Blend "Pasar Kopi"',
                'description' => 'Campuran spesial biji kopi robusta dan arabika pilihan kami untuk keseimbangan rasa yang sempurna.',
                'price' => 110000,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=House+Blend'
            ],
            [
                'id' => 6,
                'name' => 'Kopi Luwak Sumatra',
                'description' => 'Salah satu kopi termahal di dunia, diproses secara alami oleh luwak untuk rasa yang sangat halus.',
                'price' => 450000,
                'image' => 'https://placehold.co/600x400/555555/FFFFFF?text=Kopi+Luwak'
            ],
        ];

        // Mengirim data produk ke view 'produk'
        return view('produk', ['products' => $products]);
    }
}
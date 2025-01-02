<?php

namespace App\Http\Controllers;

use App\Models\ProductJual; // Import model ProductJual
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    // Fungsi untuk menampilkan halaman TPK
    public function index()
    {
        // Ambil semua data produk dari product_jual
        $produk = ProductJual::all();

        // Kelompokkan produk berdasarkan nama_produk dan jumlahkan jumlah dan total_harga
        $produkKelompok = $produk->groupBy('nama_brg')->map(function ($items) {
            // Total jumlah terjual per produk
            $totalJumlahTerjual = $items->sum('jumlah');
            // Total harga per produk
            $totalHarga = $items->sum('total_harga');

            $ukuran = $items->pluck('ukuran')->unique()->implode(', ');

            $stok = $items->first()->product ? $items->first()->product->stok : null;
            
            // Mengembalikan hasil setelah dikelompokkan
            return [
                'nama_brg' => $items->first()->nama_brg,
                'total_jumlah' => $totalJumlahTerjual,
                'total_harga' => $totalHarga,
                'ukuran' => $ukuran,
                'stok' => $stok
            ];
        });

        // Kembalikan tampilan dengan data produk yang sudah dikelompokkan
        return view('tpk.tpk', compact('produkKelompok'));
    }
}
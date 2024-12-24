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
            
            // Mengembalikan hasil setelah dikelompokkan
            return [
                'nama_brg' => $items->first()->nama_brg,
                'total_jumlah' => $totalJumlahTerjual,
                'total_harga' => $totalHarga
            ];
        });

        // Kembalikan tampilan dengan data produk yang sudah dikelompokkan
        return view('tpk.tpk', compact('produkKelompok'));
    }

    // Fungsi untuk menghitung produk terlaris dengan metode SAW
    public function hitungTerlaris(Request $request)
    {
        // Ambil semua data produk dari product_jual
        $produk = ProductJual::all();

        // Bobot untuk kriteria
        $bobotJumlahTerjual = 0.6;
        $bobotHarga = 0.4;

        // Mendapatkan nilai maksimum untuk normalisasi
        $maxJumlahTerjual = $produk->max('jumlah');
        $maxHarga = $produk->max('total_harga'); // perbaiki penggunaan kolom harga menjadi total_harga

        // Perhitungan SAW
        foreach ($produk as $p) {
            // Normalisasi jumlah terjual dan total_harga
            $p->normalisasi_terjual = $p->jumlah / $maxJumlahTerjual;
            $p->normalisasi_harga = $p->total_harga / $maxHarga;

            // Perhitungan nilai SAW
            $p->nilai_saw = ($p->normalisasi_terjual * $bobotJumlahTerjual) + ($p->normalisasi_harga * $bobotHarga);
        }

        // Urutkan berdasarkan nilai SAW secara menurun
        $produkTerlaris = $produk->sortByDesc('nilai_saw');

        // Kembalikan tampilan dengan dua tabel: produk dan hasil perhitungan
        return view('tpk.tpk', compact('produk', 'produkTerlaris'));
    }
}

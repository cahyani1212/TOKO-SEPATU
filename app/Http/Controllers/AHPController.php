<?php

namespace App\Http\Controllers;

use App\Models\AhpKriteria;
use Illuminate\Http\Request;

class AHPController extends Controller
{
    public function index()
    {
        // Ambil data produk dari model
        $produkModel = new AhpKriteria();
        $produk = $produkModel->getProduk(); // Memanggil metode getProduk()

        // dd($produk);

        
        // Langkah 1: Tentukan Bobot Kriteria
        $bobot = [
            'total_jumlah' => 0.4, // Bobot untuk Jumlah Penjualan
            'total_harga_satuan' => 0.3,            // Bobot untuk Harga
            'ukuran' => 0.2,           // Bobot untuk Ukuran
            'stok' => 0.1              // Bobot untuk Stok
        ];

        // Langkah 2: Normalisasi dan Hitung Skor SAW
        $produkArray = $produk->toArray(); // Mengonversi koleksi menjadi array untuk menggunakan array_column()

        // Cari nilai maksimum untuk setiap kriteria
        $maxJumlahPenjualan = max(array_column($produkArray, 'total_jumlah'));
        $maxHarga = max(array_column($produkArray, 'total_harga_satuan'));
        $maxUkuran = max(array_column($produkArray, 'ukuran'));
        $maxStok = max(array_column($produkArray, 'stok'));

        foreach ($produkArray as &$p) {
            // Normalisasi
            $p['normalisasi_jumlah'] = $p['total_jumlah'] / $maxJumlahPenjualan;
            $p['normalisasi_harga'] = $p['total_harga_satuan'] / $maxHarga;
            $p['normalisasi_ukuran'] = $p['ukuran'] / $maxUkuran;
            $p['normalisasi_stok'] = $p['stok'] / $maxStok;

            // Hitung Skor Akhir (SAW)
            $p['skor'] = (
                ($bobot['total_jumlah'] * $p['normalisasi_jumlah']) +
                ($bobot['total_harga_satuan'] * $p['normalisasi_harga']) +
                ($bobot['ukuran'] * $p['normalisasi_ukuran']) +
                ($bobot['stok'] * $p['normalisasi_stok'])
            );
        }

        // Urutkan berdasarkan skor tertinggi
        usort($produkArray, function ($a, $b) {
            return $b['skor'] <=> $a['skor'];
        });

        // Kirim data ke view
        return view('tpk.ahp', [
            'produk' => $produkArray,
            'bobot' => $bobot
        ]);
    }
}
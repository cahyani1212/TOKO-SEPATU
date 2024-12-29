<?php

namespace App\Http\Controllers;

use App\Models\AhpKriteria;
use App\Models\Kriteria;
use App\Models\PerbandinganKriteria; // Pastikan model ini ada
use Illuminate\Http\Request;

class AHPController extends Controller
{
    public function index()
    {
        // Ambil data produk dari model
        $produkModel = new AhpKriteria();
        $produk = $produkModel->getProduk(); // Memanggil metode getProduk()

        // Langkah 1: Tentukan Bobot Kriteria dengan AHP
        $bobot = [
            'jumlah' => 0.75, // Bobot untuk Jumlah Terjual
            'harga_satuan' => 0.25      // Bobot untuk Harga Jual
        ];

        // Langkah 2: Normalisasi dan Hitung Skor SAW
        $produkArray = $produk->toArray(); // Mengonversi koleksi menjadi array untuk menggunakan array_column()

        $maxJumlahTerjual = max(array_column($produkArray, 'jumlah'));
        $maxHargaJual = max(array_column($produkArray, 'harga_satuan'));

        foreach ($produkArray as &$p) {
            // Normalisasi
            $p['normalisasi_jumlah'] = $p['jumlah'] / $maxJumlahTerjual;
            $p['normalisasi_harga'] = $p['harga_satuan'] / $maxHargaJual;

            // Hitung Skor Akhir (SAW)
            $p['skor'] = ($bobot['jumlah'] * $p['normalisasi_jumlah']) +
                         ($bobot['harga_satuan'] * $p['normalisasi_harga']);
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
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'product_jual';
    protected $fillable = ['nama_brg', 'jumlah', 'total_harga'];

    // Fungsi untuk mengelompokkan berdasarkan nama_brg
    public static function groupByNamaBrg()
    {
        // Ambil semua data produk
        $produk = self::all();

        // Kelompokkan berdasarkan nama_brg dan jumlahkan jumlah dan total_harga
        $produkKelompok = $produk->groupBy('nama_brg')->map(function ($items) {
            $totalJumlah = $items->sum('jumlah');
            $totalHarga = $items->sum('total_harga');
            
            // Mengembalikan hasil setelah dikelompokkan
            return [
                'nama_brg' => $items->first()->nama_brg,
                'total_jumlah' => $totalJumlah,
                'total_harga' => $totalHarga
            ];
        });

        return $produkKelompok;
    }

    // public function getProduk()
    // {
    //     return $this->all(); // Mengambil semua data produk
    // }
}
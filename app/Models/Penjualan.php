<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'penjualans';

    // Tentukan kolom-kolom yang bisa diisi
    protected $fillable = ['product_id', 'jumlah', 'warna', 'ukuran', 'image', 'tgl_keluar', 'harga_satuan', 'total_harga', 'nama_brg', 'catatan'];
}

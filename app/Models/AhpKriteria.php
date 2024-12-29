<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AhpKriteria extends Model
{
    protected $table = 'product_jual';
    protected $primaryKey = 'id_brg_keluar';
    protected $fillable = ['nama_brg', 'jumlah', 'harga_satuan'];

    public function getProduk()
    {
        return $this->all(); // Mengambil semua data produk
    }
}
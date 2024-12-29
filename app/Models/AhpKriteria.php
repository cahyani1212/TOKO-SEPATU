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
        // Menjumlahkan kolom jumlah dan harga_satuan, lalu mengelompokkan berdasarkan nama_brg
        return $this->selectRaw('nama_brg, SUM(jumlah) as total_jumlah, SUM(harga_satuan) as total_harga_satuan')
                    ->groupBy('nama_brg')
                    ->get();
    }
}
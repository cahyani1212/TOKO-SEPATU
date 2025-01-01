<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AhpKriteria extends Model
{
    protected $table = 'product_jual';
    protected $primaryKey = 'id_brg_keluar';
    protected $fillable = ['nama_brg', 'jumlah', 'harga_satuan', 'ukuran' ];

    public function getProduk()
    {
        // Melakukan join dengan tabel 'product' untuk mendapatkan stok dari produk yang ada
        return $this->join('products', 'products.id', '=', 'product_jual.product_id')
            ->selectRaw('product_jual.nama_brg, 
                        SUM(product_jual.jumlah) as total_jumlah, 
                        SUM(product_jual.harga_satuan) as total_harga_satuan, 
                        products.ukuran as ukuran, 
                        products.stok as stok')
            ->groupBy('product_jual.nama_brg', 'products.stok', 'products.ukuran')
            ->get();

    }
}
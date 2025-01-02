<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AhpKriteria extends Model
{
    protected $table = 'product_jual';
    protected $primaryKey = 'id_brg_keluar';
    protected $fillable = ['nama_brg', 'jumlah', 'harga_satuan', 'ukuran'];

    public function getProduk()
{
    // Melakukan join dengan tabel 'product' untuk mendapatkan stok dari produk yang ada
    return $this->join('products', 'products.id', '=', 'product_jual.product_id')
        ->selectRaw('product_jual.nama_brg, 
                    SUM(product_jual.jumlah * product_jual.harga_satuan) as total_harga,  
                    SUM(product_jual.jumlah) as total_jumlah, 
                    MAX(products.ukuran) as ukuran,
                    MAX(products.stok) as stok')   
        ->groupBy('product_jual.nama_brg')  // Kelompokkan hanya berdasarkan nama_brg
        ->get();
}

}
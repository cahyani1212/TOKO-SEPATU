<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductJual extends Model
{
    use HasFactory;

    protected $table = 'product_jual';

    protected $fillable = ['product_id', 'jumlah', 'warna', 'ukuran', 'image', 'tgl_keluar', 'harga_satuan', 'total_harga', 'nama_brg', 'catatan'];

    // Hubungan dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'deskripsi',
        'price',
        'foto_produk',
        'warna',
        'ukuran',
        'stok',
    ];

    public $timestamps = true; // Secara otomatis mengelola created_at dan updated_at

    /**
     * Relasi ke model Category.
     * Setiap produk memiliki satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }
}

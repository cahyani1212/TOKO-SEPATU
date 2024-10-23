<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Jika tabel di database bernama 'products', Anda tidak perlu mendefinisikan $table.
    // Jika tabel bernama lain, misalnya 'product', Anda perlu menambahkan ini:
    protected $table = 'products';

    // Mengaktifkan pengisian massal
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'image',
        'warna',
        'ukuran',
        'stok',
        'created_at',
        'updated_at', // Perbaiki dari 'update_at' menjadi 'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'warna',
        'ukuran',
        'stok',
        // 'created_at', 'updated_at' tidak perlu disertakan jika timestamps diatur otomatis
    ];

    public $timestamps = true; // Secara otomatis mengelola created_at dan updated_at
}

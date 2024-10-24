<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_jual', function (Blueprint $table) {
            $table->id(); // Primary key untuk tabel product_jual
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key untuk produk
            $table->string('nama_brg'); // Menggunakan 'jumlah' sesuai dengan controller
            $table->integer('jumlah'); // Menggunakan 'jumlah' sesuai dengan controller
            $table->string('warna'); // Kolom warna sesuai dengan data produk
            $table->string('ukuran'); // Kolom ukuran sesuai dengan data produk
            $table->date('tgl_keluar'); // Kolom tanggal keluar
            $table->decimal('harga_satuan', 12, 2); // Kolom harga satuan
            $table->decimal('total_harga', 12, 2); // Kolom total harga
            $table->text('catatan')->nullable(); // Kolom catatan
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_juals');
    }
};

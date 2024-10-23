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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->varchar('name'); // Mengganti 'id_kategori' dengan 'kategori_id'
            $table->varchar('description'); // Mengganti 'name' dengan 'nama_produk'
            $table->decimal('price')->nullable(); // Mengganti 'description' dengan 'deskripsi'
            $table->varchar('image'); 
            $table->timestamp('created_at'); 
            $table->timestamp('image');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

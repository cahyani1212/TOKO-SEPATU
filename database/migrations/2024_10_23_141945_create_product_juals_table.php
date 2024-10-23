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
            $table->id();
            $table->foreignId('id')->constrained('products')->onDelete('cascade'); // Menambahkan foreign key untuk produk
            $table->integer('quantity'); // Menambahkan kolom quantity untuk menyimpan jumlah produk yang terjual
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
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

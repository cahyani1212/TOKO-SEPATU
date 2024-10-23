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
            $table->foreignId('id')->constrained('products')->onDelete('cascade'); // Hubungkan dengan tabel produk
            $table->integer('jumlah'); // Jumlah produk yang dijual
            $table->timestamps(); // Menyimpan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_jual');
    }
};

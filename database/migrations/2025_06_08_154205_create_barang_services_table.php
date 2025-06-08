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
        Schema::create('barang_services', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang')->unique();
            $table->string('product');
            $table->string('jenis_product');
            $table->integer('stok');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal_masuk')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_services');
    }
};

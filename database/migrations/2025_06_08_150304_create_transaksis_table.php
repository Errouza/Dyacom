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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang');
            $table->string('product');
            $table->decimal('harga', 10, 2);
            $table->integer('quantity');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('buyer_name');
            $table->string('buyer_email')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

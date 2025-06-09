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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pesanan')->unique();
            $table->foreignId('id_customer')->constrained('users');
            $table->integer('quantity');
            $table->decimal('price_total', 10, 2);
            $table->enum('metode_pengambilan', ['Pickup', 'Delivery']);
            $table->enum('status_pembayaran', ['Pending', 'Selesai', 'Dibatalkan'])->default('Pending');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};

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
        Schema::table('transaksis', function (Blueprint $table) {
            // Hapus kolom yang tidak lagi relevan di tabel header
            $table->dropColumn(['id_barang', 'product', 'harga', 'quantity', 'sub_total']);

            // Tambah kolom untuk pembayaran
            $table->decimal('bayar', 15, 2)->after('total')->default(0);
            $table->decimal('kembalian', 15, 2)->after('bayar')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Kembalikan kolom yang dihapus
            $table->string('id_barang');
            $table->string('product');
            $table->decimal('harga', 10, 2);
            $table->integer('quantity');
            $table->decimal('sub_total', 10, 2);

            // Hapus kolom yang ditambahkan
            $table->dropColumn(['bayar', 'kembalian']);
        });
    }
};

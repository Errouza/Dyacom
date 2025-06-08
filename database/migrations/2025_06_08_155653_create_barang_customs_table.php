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
        Schema::create('barang_customs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_custom')->unique();
            $table->string('nama_pelanggan');
            $table->string('jenis_barang');
            $table->text('spesifikasi');
            $table->decimal('biaya_design', 10, 2)->default(0);
            $table->decimal('biaya_produksi', 10, 2)->default(0);
            $table->decimal('total_biaya', 10, 2)->default(0);
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->date('tanggal_order');
            $table->date('estimasi_selesai');
            $table->text('catatan')->nullable();
            $table->string('design_file')->nullable();
            $table->string('foto_hasil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_customs');
    }
};

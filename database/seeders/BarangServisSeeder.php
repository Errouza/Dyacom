<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BarangService;

class BarangServisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the table first to avoid duplicate data on re-seed
        BarangService::query()->delete();

        DB::table('barang_services')->insert([
            [
                'id_barang' => 'BS001',
                'product' => 'Spanduk Flexi 280g',
                'jenis_product' => 'Cetak Digital',
                'harga' => 25000,
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS002',
                'product' => 'Brosur A5 Art Paper 150g (1 Rim)',
                'jenis_product' => 'Cetak Offset',
                'harga' => 450000,
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS003',
                'product' => 'Kartu Nama Art Carton 260g (1 Box)',
                'jenis_product' => 'Cetak Digital',
                'harga' => 35000,
                'stok' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS004',
                'product' => 'Stiker Vinyl A3+',
                'jenis_product' => 'Cetak Digital',
                'harga' => 15000,
                'stok' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS005',
                'product' => 'X-Banner 60x160cm (termasuk rangka)',
                'jenis_product' => 'Display',
                'harga' => 85000,
                'stok' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS006',
                'product' => 'Roll Up Banner 85x200cm',
                'jenis_product' => 'Display',
                'harga' => 250000,
                'stok' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS007',
                'product' => 'Poster A3+ Art Paper',
                'jenis_product' => 'Cetak Digital',
                'harga' => 10000,
                'stok' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS008',
                'product' => 'Kalender Dinding 2025',
                'jenis_product' => 'Cetak Offset',
                'harga' => 40000,
                'stok' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS009',
                'product' => 'Undangan Pernikahan (per 100 pcs)',
                'jenis_product' => 'Cetak Offset',
                'harga' => 200000,
                'stok' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS010',
                'product' => 'Cetak Foto 10R',
                'jenis_product' => 'Cetak Foto',
                'harga' => 5000,
                'stok' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_barang' => 'BS011',
                'product' => 'Bendera Merah Putih 90x60cm',
                'jenis_product' => 'Lain-lain',
                'harga' => 20000,
                'stok' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

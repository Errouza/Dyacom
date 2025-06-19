<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangService extends Model
{
    protected $table = 'barang_services';

    protected $fillable = [
        'id_barang',
        'product',
        'jenis_product',
        'stok',
        'harga',
        'tanggal_masuk',
        'image'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'harga' => 'decimal:2',
    ];
}

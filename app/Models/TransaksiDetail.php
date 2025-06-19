<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'id_barang',
        'product',
        'harga',
        'quantity',
        'sub_total',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}

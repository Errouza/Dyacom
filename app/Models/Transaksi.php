<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_barang',
        'product',
        'harga',
        'quantity',
        'sub_total',
        'total',
        'buyer_name',
        'buyer_email',
        'buyer_phone'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($transaksi) {
            $transaksi->sub_total = $transaksi->harga * $transaksi->quantity;
            $transaksi->total = $transaksi->sub_total;
        });
    }
}

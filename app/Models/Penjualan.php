<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    protected $fillable = [
        'id_pesanan',
        'id_customer',
        'quantity',
        'price_total',
        'metode_pengambilan',
        'status_pembayaran',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'price_total' => 'decimal:2'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_customer');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $fillable = [
        'total',
        'bayar',
        'kembalian',
        'buyer_name',
        'buyer_email',
        'buyer_phone'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'bayar' => 'decimal:2',
        'kembalian' => 'decimal:2',
    ];

    /**
     * Get all of the details for the Transaksi.
     */
    public function details(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}

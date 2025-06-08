<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangCustom extends Model
{
    protected $fillable = [
        'kode_custom',
        'nama_pelanggan',
        'jenis_barang',
        'spesifikasi',
        'biaya_design',
        'biaya_produksi',
        'total_biaya',
        'status',
        'tanggal_order',
        'estimasi_selesai',
        'catatan',
        'design_file',
        'foto_hasil'
    ];

    protected $casts = [
        'tanggal_order' => 'date',
        'estimasi_selesai' => 'date',
        'biaya_design' => 'decimal:2',
        'biaya_produksi' => 'decimal:2',
        'total_biaya' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($barangCustom) {
            // Generate kode custom jika belum ada
            if (!$barangCustom->kode_custom) {
                $barangCustom->kode_custom = 'CST-' . date('Ymd') . '-' . str_pad(static::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);
            }
            
            // Hitung total biaya
            $barangCustom->total_biaya = $barangCustom->biaya_design + $barangCustom->biaya_produksi;
        });

        static::updating(function ($barangCustom) {
            // Update total biaya saat update
            $barangCustom->total_biaya = $barangCustom->biaya_design + $barangCustom->biaya_produksi;
        });
    }

    public function getStatusBadgeClassAttribute()
    {
        return [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ][$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'Menunggu',
            'in_progress' => 'Dalam Proses',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ][$this->status] ?? 'Unknown';
    }
}

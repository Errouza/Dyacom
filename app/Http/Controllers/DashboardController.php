<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\BarangService;
use App\Models\BarangCustom;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        // Total penjualan hari ini
        $totalPenjualanHariIni = Transaksi::whereDate('created_at', $today)
            ->sum('total');
            
        // Total barang terjual hari ini
        $totalBarangTerjual = TransaksiDetail::whereHas('transaksi', function($query) use ($today) {
                $query->whereDate('created_at', $today);
            })
            ->sum('quantity');
            
        // Statistik Barang Custom
        $barangCustomMasukHariIni = BarangCustom::whereDate('created_at', $today)->count();
        $prosesPengerjaan = BarangCustom::where('status', 'proses')->count();
        $pengerjaanSelesai = BarangCustom::where('status', 'selesai')->count();
        $barangDiambil = BarangCustom::where('status', 'diambil')->count();
        
        return view('welcome', [
            'totalPenjualanHariIni' => $totalPenjualanHariIni,
            'totalBarangTerjual' => $totalBarangTerjual,
            'barangCustomMasukHariIni' => $barangCustomMasukHariIni,
            'prosesPengerjaan' => $prosesPengerjaan,
            'pengerjaanSelesai' => $pengerjaanSelesai,
            'barangDiambil' => $barangDiambil
        ]);
    }
}

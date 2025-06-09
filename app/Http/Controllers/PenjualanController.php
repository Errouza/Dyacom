<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penjualan::with('customer');

        // Date filtering
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('tanggal', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        $penjualans = $query->latest('tanggal')->paginate(10);
        
        return view('penjualan.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = User::all();
        return view('penjualan.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|unique:penjualans',
            'id_customer' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'price_total' => 'required|numeric|min:0',
            'metode_pengambilan' => 'required|in:Pickup,Delivery',
            'status_pembayaran' => 'required|in:Pending,Selesai,Dibatalkan',
            'tanggal' => 'required|date',
        ]);

        Penjualan::create($validated);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $customers = User::all();
        return view('penjualan.edit', compact('penjualan', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|unique:penjualans,id_pesanan,' . $penjualan->id,
            'id_customer' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'price_total' => 'required|numeric|min:0',
            'metode_pengambilan' => 'required|in:Pickup,Delivery',
            'status_pembayaran' => 'required|in:Pending,Selesai,Dibatalkan',
            'tanggal' => 'required|date',
        ]);

        $penjualan->update($validated);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil dihapus.');
    }

    /**
     * Display the invoice for the specified resource.
     */
    public function invoice(Penjualan $penjualan)
    {
        return view('penjualan.invoice', compact('penjualan'));
    }

    /**
     * Download the invoice for the specified resource as a PDF.
     */
    public function downloadInvoice(Penjualan $penjualan)
    {
        $pdf = Pdf::loadView('penjualan.invoice', compact('penjualan'))
            ->setPaper('a4')
            ->setWarnings(false);
            
        return $pdf->download('INV-' . $penjualan->id_pesanan . '.pdf');
    }
}

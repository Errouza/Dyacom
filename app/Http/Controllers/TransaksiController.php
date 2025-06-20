<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\BarangService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|json',
            'total' => 'required|numeric|min:0',
            'bayar' => 'required|numeric|min:0',
            'kembalian' => 'required|numeric',
            'buyer_name' => 'nullable|string|max:255',
            'buyer_email' => 'nullable|email|max:255',
            'buyer_phone' => 'nullable|string|max:255',
        ]);

        $items = json_decode($validated['items'], true);

        try {
            DB::transaction(function () use ($request, $validated, $items) {
                // 1. Create the main transaction record
                $transaksi = Transaksi::create([
                    'total' => $validated['total'],
                    'bayar' => $validated['bayar'],
                    'kembalian' => $validated['kembalian'],
                    'buyer_name' => $request->input('buyer_name'),
                    'buyer_email' => $request->input('buyer_email'),
                    'buyer_phone' => $request->input('buyer_phone'),
                ]);

                // 2. Create the transaction detail records and update stock
                foreach ($items as $item) {
                    // Create transaction detail
                    $transaksi->details()->create([
                        'id_barang' => $item['id_barang'],
                        'product' => $item['product'],
                        'harga' => $item['harga'],
                        'quantity' => $item['quantity'],
                        'sub_total' => $item['sub_total'],
                    ]);
                    
                    // Update stock in barang_service
                    $barangService = BarangService::where('id_barang', $item['id_barang'])->first();
                    
                    if ($barangService) {
                        if ($barangService->stok < $item['quantity']) {
                            throw new \Exception('Stok tidak mencukupi untuk produk: ' . $item['product']);
                        }
                        
                        $barangService->decrement('stok', $item['quantity']);
                    }
                }
            });

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil disimpan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan transaksi. Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        // Eager load the details relationship
        $transaksi->load('details');
        
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'id_barang' => 'required|string',
            'product' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'buyer_name' => 'required|string',
            'buyer_email' => 'nullable|email',
            'buyer_phone' => 'nullable|string'
        ]);

        $transaksi->update($validated);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * AJAX: Cari barang berdasarkan ID
     */
    public function cariBarang(Request $request)
    {
        $id_barang = $request->input('id_barang');
        $barang = BarangService::where('id_barang', $id_barang)->first();
        if ($barang) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id_barang' => $barang->id_barang,
                    'product' => $barang->product,
                    'harga' => $barang->harga,
                ]
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan']);
        }
    }
}

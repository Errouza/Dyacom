<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

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
            'id_barang' => 'required|string',
            'product' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'buyer_name' => 'required|string',
            'buyer_email' => 'nullable|email',
            'buyer_phone' => 'nullable|string'
        ]);

        $transaksi = Transaksi::create($validated);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
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
}

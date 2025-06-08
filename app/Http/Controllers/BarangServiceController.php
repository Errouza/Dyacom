<?php

namespace App\Http\Controllers;

use App\Models\BarangService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangServices = BarangService::latest()->paginate(10);
        return view('barang-service.index', compact('barangServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_barang' => 'required|string|unique:barang_services',
            'product' => 'required|string',
            'jenis_product' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('barang-services', 'public');
            $validated['image'] = $imagePath;
        }

        BarangService::create($validated);

        return redirect()->route('barang-service.index')
            ->with('success', 'Data barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangService $barangService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangService $barangService)
    {
        return view('barang-service.edit', compact('barangService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangService $barangService)
    {
        $validated = $request->validate([
            'id_barang' => 'required|string|unique:barang_services,id_barang,' . $barangService->id,
            'product' => 'required|string',
            'jenis_product' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($barangService->image) {
                Storage::disk('public')->delete($barangService->image);
            }
            $imagePath = $request->file('image')->store('barang-services', 'public');
            $validated['image'] = $imagePath;
        }

        $barangService->update($validated);

        return redirect()->route('barang-service.index')
            ->with('success', 'Data barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangService $barangService)
    {
        if ($barangService->image) {
            Storage::disk('public')->delete($barangService->image);
        }
        
        $barangService->delete();

        return redirect()->route('barang-service.index')
            ->with('success', 'Data barang berhasil dihapus');
    }
}

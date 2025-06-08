<?php

namespace App\Http\Controllers;

use App\Models\BarangCustom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangCustomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangCustoms = BarangCustom::latest()->paginate(10);
        return view('barang-custom.index', compact('barangCustoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-custom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'spesifikasi' => 'required|string',
            'biaya_design' => 'required|numeric|min:0',
            'biaya_produksi' => 'required|numeric|min:0',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'tanggal_order' => 'required|date',
            'estimasi_selesai' => 'required|date|after_or_equal:tanggal_order',
            'catatan' => 'nullable|string',
            'design_file' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png',
            'foto_hasil' => 'nullable|image|max:5120|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('design_file')) {
            $validated['design_file'] = $request->file('design_file')
                ->store('barang-customs/designs', 'public');
        }

        if ($request->hasFile('foto_hasil')) {
            $validated['foto_hasil'] = $request->file('foto_hasil')
                ->store('barang-customs/photos', 'public');
        }

        BarangCustom::create($validated);

        return redirect()->route('barang-custom.index')
            ->with('success', 'Data barang custom berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangCustom $barangCustom)
    {
        return view('barang-custom.show', compact('barangCustom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangCustom $barangCustom)
    {
        return view('barang-custom.edit', compact('barangCustom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangCustom $barangCustom)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'spesifikasi' => 'required|string',
            'biaya_design' => 'required|numeric|min:0',
            'biaya_produksi' => 'required|numeric|min:0',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'tanggal_order' => 'required|date',
            'estimasi_selesai' => 'required|date|after_or_equal:tanggal_order',
            'catatan' => 'nullable|string',
            'design_file' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png',
            'foto_hasil' => 'nullable|image|max:5120|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('design_file')) {
            if ($barangCustom->design_file) {
                Storage::disk('public')->delete($barangCustom->design_file);
            }
            $validated['design_file'] = $request->file('design_file')
                ->store('barang-customs/designs', 'public');
        }

        if ($request->hasFile('foto_hasil')) {
            if ($barangCustom->foto_hasil) {
                Storage::disk('public')->delete($barangCustom->foto_hasil);
            }
            $validated['foto_hasil'] = $request->file('foto_hasil')
                ->store('barang-customs/photos', 'public');
        }

        $barangCustom->update($validated);

        return redirect()->route('barang-custom.index')
            ->with('success', 'Data barang custom berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangCustom $barangCustom)
    {
        if ($barangCustom->design_file) {
            Storage::disk('public')->delete($barangCustom->design_file);
        }
        if ($barangCustom->foto_hasil) {
            Storage::disk('public')->delete($barangCustom->foto_hasil);
        }
        
        $barangCustom->delete();

        return redirect()->route('barang-custom.index')
            ->with('success', 'Data barang custom berhasil dihapus');
    }

    public function updateStatus(Request $request, BarangCustom $barangCustom)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        $barangCustom->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'new_status' => $barangCustom->status_label,
            'new_badge_class' => $barangCustom->status_badge_class
        ]);
    }
}

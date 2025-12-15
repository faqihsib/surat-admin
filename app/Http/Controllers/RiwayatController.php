<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatStatusSurat;
use App\Models\PermohonanSurat;
use App\Models\Warga;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RiwayatStatusSurat::with(['permohonan', 'petugas'])->latest()->get();
        return view('pages.riwayat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permohonan = PermohonanSurat::all();
        // Mengambil data warga untuk dijadikan petugas (simulasi)
        $warga = Warga::all();
        return view('pages.riwayat.create', compact('permohonan', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permohonan_id' => 'required',
            'status' => 'required',
            'petugas_warga_id' => 'required',
            'keterangan' => 'required'
        ]);

        RiwayatStatusSurat::create([
            'permohonan_id' => $request->permohonan_id,
            'status' => $request->status,
            'petugas_warga_id' => $request->petugas_warga_id,
            'waktu' => now(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Riwayat berhasil dicatat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $riwayat = RiwayatStatusSurat::findOrFail($id); // Pastikan ini ada
        return view('pages.riwayat.edit', compact('riwayat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $riwayat = RiwayatStatusSurat::findOrFail($id);

        $request->validate([
            'status'     => 'required',
            'waktu'      => 'required', // datetime-local input
            'keterangan' => 'required',
        ]);

        $riwayat->update([
            'status'     => $request->status,
            'waktu'      => $request->waktu,
            'keterangan' => $request->keterangan,
            // Catatan: permohonan_id dan petugas_warga_id tidak diupdate (readonly)
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Riwayat status berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RiwayatStatusSurat::findOrFail($id)->delete();
        return redirect()->route('riwayat.index')->with('success', 'Riwayat dihapus');
    }
}

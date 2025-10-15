<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_surat = [
            [
                'jenis_id' => 1,
                'kode' => 'SKM',
                'nama_jenis' => 'Surat Keterangan Miskin',
                'syarat_json' => 'KTP,KK,Surat Pengantar RT'
            ],
            [
                'jenis_id' => 2,
                'kode' => 'SKD',
                'nama_jenis' => 'Surat Keterangan Domisili',
                'syarat_json' => 'KTP,KK,Bukti Sewa/Kontrak'
            ],
            [
                'jenis_id' => 3,
                'kode' => 'SKB',
                'nama_jenis' => 'Surat Keterangan Belum Menikah',
                'syarat_json' => 'KTP,KK,Surat Pengantar RT'
            ]
        ];

        return view('jenis-surat', compact('jenis_surat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form-jenis-surat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama_jenis' => 'required'
        ]);

        JenisSurat::create([
            'kode' => $request->kode,
            'nama_jenis' => $request->nama_jenis,
            'syarat_json' => $request->syarat_json
        ]);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan');
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
        $jenis_surat = [
            'jenis_id' => $id,
            'kode' => 'SKM',
            'nama_jenis' => 'Surat Keterangan Miskin',
            'syarat_json' => 'KTP,KK,Surat Pengantar RT'
        ];

        return view('form-jenis-surat', compact('jenis_surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required'
        ]);

        $jenis_surat = JenisSurat::find($id);
        $jenis_surat->update([
            'kode' => $request->kode,
            'nama_jenis' => $request->nama_jenis,
            'syarat_json' => $request->syarat_json
        ]);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis_surat = JenisSurat::find($id);
        $jenis_surat->delete();

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus');
    }
}

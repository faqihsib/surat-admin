<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataJenisSurat'] = DB::table('jenis_surat')->get();
        return view('jenis-surat', $data);
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
        // Validasi
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama_jenis' => 'required'
        ]);

        // Simpan data menggunakan Query Builder (bukan Eloquent)
        DB::table('jenis_surat')->insert([
            'kode' => $request->kode,
            'nama_jenis' => $request->nama_jenis,
            'syarat_json' => $request->syarat_json,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil ditambahkan!');
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
        $dataJenisSurat = DB::table('jenis_surat')->where('jenis_id', $id)->first();
        return view('form-jenis-surat', compact('dataJenisSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required'
        ]);

        // Update data menggunakan Query Builder (bukan Eloquent)
        DB::table('jenis_surat')->where('jenis_id', $id)->update([
            'kode' => $request->kode,
            'nama_jenis' => $request->nama_jenis,
            'syarat_json' => $request->syarat_json,
            'updated_at' => now()
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data menggunakan Query Builder (bukan Eloquent)
        DB::table('jenis_surat')->where('jenis_id', $id)->delete();

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus!');
    }
}

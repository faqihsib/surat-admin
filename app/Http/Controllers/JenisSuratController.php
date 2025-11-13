<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataJenisSurat'] = JenisSurat::all();
        return view('pages.jenis-surat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jenis-surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama_jenis' => 'required',
        ]);

        $data['kode'] = $request->kode;
        $data['nama_jenis'] = $request->nama_jenis;
        $data['syarat_json'] = $request->syarat_json;

        JenisSurat::create($data);

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
        $data['dataJenisSurat'] = JenisSurat::findOrFail($id);
        return view('pages.jenis-surat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis_id = $id;
        $dataJenisSurat = JenisSurat::findOrFail($jenis_id);

        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required',
        ]);

        $dataJenisSurat->kode = $request->kode;
        $dataJenisSurat->nama_jenis = $request->nama_jenis;
        $dataJenisSurat->syarat_json = $request->syarat_json;

        $dataJenisSurat->save();
        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $jenisSurat->delete();

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus!');
    }
}

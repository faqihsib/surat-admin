<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DATA DUMMY SEMENTARA (sebelum migration)
        $warga = [
            [
                'warga_id' => 1,
                'no_ktp' => '1234567890123456',
                'nama' => 'Ahmad Santoso',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'pekerjaan' => 'Wiraswasta',
                'telp' => '081234567890',
                'email' => 'ahmad@example.com'
            ],
            [
                'warga_id' => 2,
                'no_ktp' => '1234567890123457',
                'nama' => 'Siti Rahayu',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'pekerjaan' => 'Ibu Rumah Tangga',
                'telp' => '081234567891',
                'email' => 'siti@example.com'
            ],
            [
                'warga_id' => 3,
                'no_ktp' => '1234567890123458',
                'nama' => 'Budi Pratama',
                'jenis_kelamin' => 'L',
                'agama' => 'Kristen',
                'pekerjaan' => 'PNS',
                'telp' => '081234567892',
                'email' => 'budi@example.com'
            ]
        ];

        return view('data-warga', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form-warga');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required|email'
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan');
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
        $warga = [
            'warga_id' => $id,
            'no_ktp' => '1234567890123456',
            'nama' => 'Warga Contoh',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'pekerjaan' => 'Contoh Pekerjaan',
            'telp' => '081234567890',
            'email' => 'contoh@example.com'
        ];

        return view('form-warga', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required|email'
        ]);

        $warga = Warga::find($id);
        $warga->update($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = Warga::find($id);
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus');
    }
}

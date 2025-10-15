<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataWarga'] = DB::table('warga')->get();
        return view('data-warga', $data);
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
        // Validasi
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required|email'
        ]);

        // Simpan data menggunakan Query Builder (bukan Eloquent)
        DB::table('warga')->insert([
            'no_ktp' => $request->no_ktp,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'telp' => $request->telp,
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
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
        $warga = DB::table('warga')->where('warga_id', $id)->first();
        return view('form-warga', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required|email'
        ]);

        // Update data menggunakan Query Builder (bukan Eloquent)
        DB::table('warga')->where('warga_id', $id)->update([
            'no_ktp' => $request->no_ktp,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'telp' => $request->telp,
            'email' => $request->email,
            'updated_at' => now()
        ]);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data menggunakan Query Builder (bukan Eloquent)
        DB::table('warga')->where('warga_id', $id)->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}

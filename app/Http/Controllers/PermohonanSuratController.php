<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    /**
     * Menampilkan daftar permohonan surat.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status'];

        $data['dataPermohonan'] = PermohonanSurat::with(['pemohon', 'jenisSurat'])
                                    ->filter($request, $filterableColumns)
                                    ->paginate(10) // Pagination
                                    ->withQueryString();

        return view('pages.permohonan-surat.index', $data); 

        // $data['dataPermohonan'] = PermohonanSurat::with(['pemohon', 'jenisSurat'])->get();

        // return view('pages.permohonan-surat.index', $data);
    }

    /**
     * Menampilkan form untuk membuat permohonan baru.
     */
    public function create()
    {
        // Kita perlu mengirim daftar warga dan jenis surat ke view
        // untuk mengisi <select> dropdown.
        $data['dataWarga'] = Warga::all();
        $data['dataJenisSurat'] = JenisSurat::all();

        return view('pages.permohonan-surat.create', $data);
    }

    /**
     * Menyimpan permohonan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan',
            'pemohon_warga_id' => 'required|exists:warga,warga_id', // Pastikan warga_id ada di tabel warga
            'jenis_id' => 'required|exists:jenis_surat,jenis_id', // Pastikan jenis_id ada
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
        ]);

        PermohonanSurat::create($request->all());

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail spesifik (jika diperlukan).
     */
    public function show(string $id)
    {
        $data['permohonan'] = PermohonanSurat::with(['pemohon', 'jenisSurat'])->findOrFail($id);
        return view('pages.permohonan-surat.show', $data);
    }

    /**
     * Menampilkan form untuk mengedit permohonan.
     */
    public function edit(string $id)
    {
        // Ambil data permohonan yang spesifik
        $data['permohonan'] = PermohonanSurat::findOrFail($id);

        // Ambil data relasi untuk mengisi dropdown
        $data['dataWarga'] = Warga::all();
        $data['dataJenisSurat'] = JenisSurat::all();

        return view('pages.permohonan-surat.edit', $data);
    }

    /**
     * Mengupdate data permohonan di database.
     */
    public function update(Request $request, string $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        $request->validate([
            // Pastikan nomor permohonan unik, kecuali untuk ID saat ini
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
        ]);

        $permohonan->update($request->all());

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil diupdate!');
    }

    /**
     * Menghapus data permohonan dari database.
     */
    public function destroy(string $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->delete();

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil dihapus!');
    }
}

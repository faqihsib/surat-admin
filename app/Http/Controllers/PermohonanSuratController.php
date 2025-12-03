<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use App\Models\Multiuploads; // Import Model Upload
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Import Facade File

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
                                    ->latest()
                                    ->paginate(10)
                                    ->withQueryString();

        return view('pages.permohonan-surat.index', $data);
    }

    /**
     * Menampilkan form untuk membuat permohonan baru.
     */
    public function create()
    {
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
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
            'files.*' => 'mimes:doc,docx,pdf,jpg,jpeg,png|max:2048',
        ]);

        // 1. Simpan Data Utama
        $permohonan = PermohonanSurat::create($request->except('files'));

        // 2. Proses Upload File
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $file->move(public_path('uploads'), $filename);

                    Multiuploads::create([
                        'filename'  => $filename,
                        'ref_table' => 'permohonan_surat',
                        'ref_id'    => $permohonan->permohonan_id,
                    ]);
                }
            }
        }

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail spesifik (SOLUSI ERROR UNDEFINED VARIABLE FILES).
     */
    public function show(string $id)
    {
        // Ambil data permohonan
        $permohonan = PermohonanSurat::with(['pemohon', 'jenisSurat'])->findOrFail($id);

        // SOLUSI ERROR: Kita ambil data file dari tabel multiuploads
        $files = Multiuploads::where('ref_table', 'permohonan_surat')
                             ->where('ref_id', $id)
                             ->get();

        // Kita kirimkan $files ke view menggunakan compact
        return view('pages.permohonan-surat.show', compact('permohonan', 'files'));
    }

    /**
     * Menampilkan form untuk mengedit permohonan.
     */
    public function edit(string $id)
    {
        $data['permohonan'] = PermohonanSurat::findOrFail($id);
        $data['dataWarga'] = Warga::all();
        $data['dataJenisSurat'] = JenisSurat::all();

        return view('pages.permohonan-surat.edit', $data);
    }

    /**
     * Mengupdate data permohonan di database (SOLUSI FILE TIDAK TERSIMPAN SAAT EDIT).
     */
    public function update(Request $request, string $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
            'files.*' => 'mimes:doc,docx,pdf,jpg,jpeg,png|max:2048',
        ]);

        // 1. Update Data Utama
        $permohonan->update($request->except('files'));

        // 2. SOLUSI: Proses Upload File Tambahan (Susulan)
        // Bagian ini TIDAK ADA di codingan lama Anda, makanya file tidak masuk database
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());

                    // Pastikan folder uploads ada di public
                    $file->move(public_path('uploads'), $filename);

                    Multiuploads::create([
                        'filename'  => $filename,
                        'ref_table' => 'permohonan_surat',
                        'ref_id'    => $id, // ID permohonan yang sedang diedit
                    ]);
                }
            }
        }

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil diupdate!');
    }

    /**
     * Menghapus data permohonan dari database.
     */
    public function destroy(string $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        // Hapus file fisik dan record di multiuploads
        $files = Multiuploads::where('ref_table', 'permohonan_surat')->where('ref_id', $id)->get();
        foreach($files as $file){
            if(File::exists(public_path('uploads/' . $file->filename))){
                File::delete(public_path('uploads/' . $file->filename));
            }
            $file->delete();
        }

        $permohonan->delete();

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil dihapus!');
    }

    /**
     * Fungsi Hapus File Spesifik (Untuk tombol hapus di halaman Detail)
     */
    public function deleteFile($id)
    {
        $file = Multiuploads::findOrFail($id);

        // Hapus file fisik
        if(File::exists(public_path('uploads/' . $file->filename))){
            File::delete(public_path('uploads/' . $file->filename));
        }

        $permohonanId = $file->ref_id; // Simpan ID untuk redirect
        $file->delete(); // Hapus dari DB

        return redirect()->route('permohonan-surat.show', $permohonanId)->with('success', 'Berkas berhasil dihapus.');
    }
}

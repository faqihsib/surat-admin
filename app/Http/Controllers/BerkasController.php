<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use App\Models\Media;
use Illuminate\Support\Facades\File;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BerkasPersyaratan::with('permohonan', 'media')->latest()->get();
        return view('pages.berkas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permohonan = PermohonanSurat::all();
        return view('pages.berkas.create', compact('permohonan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permohonan_id' => 'required',
            'nama_berkas' => 'required',
            'file' => 'required|mimes:pdf,jpg,png|max:2048'
        ]);

        $berkas = BerkasPersyaratan::create([
            'permohonan_id' => $request->permohonan_id,
            'nama_berkas' => $request->nama_berkas,
            'valid' => 0
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            Media::create([
                'ref_table'  => 'berkas_persyaratan',
                'ref_id'     => $berkas->berkas_id,
                'file_url'   => $filename,
                'caption'    => $request->nama_berkas,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => 0
            ]);
        }

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil ditambahkan');
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
        $berkas = BerkasPersyaratan::findOrFail($id);
        return view('pages.berkas.edit', compact('berkas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);

        $request->validate([
            'nama_berkas' => 'required',
            'valid'       => 'required|boolean', // 1 (Valid) atau 0 (Tidak Valid)
        ]);

        $berkas->update([
            'nama_berkas' => $request->nama_berkas,
            'valid'       => $request->valid,
        ]);

        return redirect()->route('berkas.index')->with('success', 'Data berkas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);

        // Hapus Media terkait jika ada (Optional tapi bagus)
        $media = Media::where('ref_table', 'berkas_persyaratan')->where('ref_id', $id)->first();
        if($media) {
            if(File::exists(public_path('uploads/' . $media->file_url))) {
                File::delete(public_path('uploads/' . $media->file_url));
            }
            $media->delete();
        }

        $berkas->delete();
        return redirect()->route('berkas.index')->with('success', 'Berkas dihapus');
    }
}

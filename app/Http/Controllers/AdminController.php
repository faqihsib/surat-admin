<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warga;
use App\Models\PermohonanSurat;
use App\Models\JenisSurat;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Menghitung Data Statistik untuk Kartu Atas
        $total_warga = Warga::count();

        // Menghitung permohonan yang dibuat HARI INI
        $permohonan_hari_ini = PermohonanSurat::whereDate('created_at', Carbon::today())->count();

        // Menghitung status spesifik
        $permohonan_diproses = PermohonanSurat::where('status', 'Diproses')->count();
        $permohonan_selesai = PermohonanSurat::where('status', 'Selesai')->count();

        // 2. Mengambil Data untuk Tabel "Daftar Permohonan Terbaru"
        // Kita ambil 5 data terakhir, lengkap dengan relasi pemohon dan jenis surat
        $permohonan_terbaru = PermohonanSurat::with(['pemohon', 'jenisSurat'])
                                ->latest()
                                ->take(5)
                                ->get();

        // 3. Mengambil Data untuk Grafik (Opsional, contoh sederhana per bulan)
        // Disini kita kirim data count saja untuk simplicity
        $total_permohonan = PermohonanSurat::count();

        return view('pages.admin.dashboard', compact(
            'total_warga',
            'permohonan_hari_ini',
            'permohonan_diproses',
            'permohonan_selesai',
            'permohonan_terbaru',
            'total_permohonan'
        ));
    }

    public function about()
    {
        return view('pages.admin.about');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

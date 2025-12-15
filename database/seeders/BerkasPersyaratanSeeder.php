<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use App\Models\Media;

class BerkasPersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permohonan = PermohonanSurat::all();

        foreach ($permohonan as $p) {
            // 1. Buat Data Berkas (Scan KTP)
            $berkas = BerkasPersyaratan::create([
                'permohonan_id' => $p->permohonan_id,
                'nama_berkas'   => 'Scan KTP Asli',
                'valid'         => true, // Anggap valid
            ]);

            // 2. Buat Data Media Palsu (Agar tidak error saat diklik lihat)
            // Pastikan ada file dummy bernama 'example.jpg' di public/uploads/ atau ganti nama filenya
            // Disini kita pakai 'default.jpg' sebagai placeholder
            Media::create([
                'ref_table'  => 'berkas_persyaratan',
                'ref_id'     => $berkas->berkas_id,
                'file_url'   => 'default.jpg', // Placeholder nama file
                'caption'    => 'Scan KTP ' . $p->nomor_permohonan,
                'mime_type'  => 'image/jpeg',
                'sort_order' => 1
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RiwayatStatusSurat;
use App\Models\PermohonanSurat;
use App\Models\Warga;

class RiwayatStatusSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permohonan = PermohonanSurat::all();

        // Ambil satu warga acak untuk dijadikan 'Petugas'
        $petugas = Warga::first();

        // Jika tidak ada warga, skip seeder ini
        if (!$petugas || $permohonan->isEmpty()) {
            return;
        }

        foreach ($permohonan as $p) {
            // Buat Riwayat 'Diajukan'
            RiwayatStatusSurat::create([
                'permohonan_id'    => $p->permohonan_id,
                'status'           => 'Diajukan',
                'petugas_warga_id' => $petugas->warga_id,
                'waktu'            => $p->created_at, // Samakan dengan waktu buat permohonan
                'keterangan'       => 'Permohonan baru masuk sistem.'
            ]);

            // Opsional: Jika status permohonan sudah 'Selesai', tambahkan riwayat 'Selesai'
            if ($p->status == 'Selesai') {
                RiwayatStatusSurat::create([
                    'permohonan_id'    => $p->permohonan_id,
                    'status'           => 'Selesai',
                    'petugas_warga_id' => $petugas->warga_id,
                    'waktu'            => now(),
                    'keterangan'       => 'Surat telah diterbitkan dan diserahkan.'
                ]);
            }
        }
    }
}

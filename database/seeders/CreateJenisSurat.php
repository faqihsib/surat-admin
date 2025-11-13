<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateJenisSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data ini lebih baik manual (spesifik) daripada acak
        DB::table('jenis_surat')->insert([
            [
                'kode' => 'SKTM',
                'nama_jenis' => 'Surat Keterangan Tidak Mampu',
                'syarat_json' => json_encode("KTP. Fotocopy KK, Akte"),
            ],
            [
                'kode' => 'SKD',
                'nama_jenis' => 'Surat Keterangan Domisili',
                'syarat_json' => json_encode("Surat Pengantar RT/RW"),
            ],
            [
                'kode' => 'SKU',
                'nama_jenis' => 'Surat Keterangan Usaha',
                'syarat_json' => json_encode("Fotokopi KTP, Foto Tempat Usaha"),
            ]
        ]);
    }
}

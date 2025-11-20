<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateJenisSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data ini lebih baik manual (spesifik) daripada acak
        // DB::table('jenis_surat')->insert([
        //     [
        //         'kode' => 'SKTM',
        //         'nama_jenis' => 'Surat Keterangan Tidak Mampu',
        //         'syarat_json' => json_encode("KTP. Fotocopy KK, Akte"),
        //     ],
        //     [
        //         'kode' => 'SKD',
        //         'nama_jenis' => 'Surat Keterangan Domisili',
        //         'syarat_json' => json_encode("Surat Pengantar RT/RW"),
        //     ],
        //     [
        //         'kode' => 'SKU',
        //         'nama_jenis' => 'Surat Keterangan Usaha',
        //         'syarat_json' => json_encode("Fotokopi KTP, Foto Tempat Usaha"),
        //     ]
        // ]);
        $faker = Faker::create('id_ID');

        foreach (range(1, 100) as $index) {
            DB::table('jenis_surat')->insert([
                // Membuat Kode Unik: S-001, S-002, dst atau acak
                'kode' => $faker->unique()->bothify('SRT-###'),

                // Nama surat acak, misal: "Surat Izin Keramaian"
                'nama_jenis' => 'Surat ' . $faker->words(2, true),

                // Syarat acak
                'syarat_json' => "KTP, KK, " . $faker->word,

                // 'created_at' => $now,
                // 'updated_at' => $now,
            ]);
        }
    }
}

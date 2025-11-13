<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CreatePermohonanSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Ambil SEMUA ID yang ada dari tabel Warga dan JenisSurat
        //    Pastikan seeder Warga & JenisSurat sudah dijalankan sebelumnya!
        $wargaIds = DB::table('warga')->pluck('warga_id');
        $jenisIds = DB::table('jenis_surat')->pluck('jenis_id');

        // 2. Cek apakah data sudah ada
        if ($wargaIds->isEmpty() || $jenisIds->isEmpty()) {
            $this->command->error('Tabel Warga atau JenisSurat masih kosong.');
            $this->command->error('Silakan jalankan `CreateWargaDummy` dan `CreateJenisSuratDummy` terlebih dahulu.');
            return;
        }

        // 3. Buat 100 data permohonan dummy
        foreach (range(1, 100) as $index) {
            DB::table('permohonan_surat')->insert([
                'nomor_permohonan' => $faker->unique()->numerify('SURAT/####/XI/2025'),

                // Ambil ID acak dari data yang sudah ada
                'pemohon_warga_id' => $faker->randomElement($wargaIds),
                'jenis_id' => $faker->randomElement($jenisIds),

                'tanggal_pengajuan' => $faker->dateTimeBetween('-1 year', 'now'),
                'status' => $faker->randomElement(['Diajukan', 'Diproses', 'Selesai', 'Ditolak']),
                'catatan' => $faker->optional()->sentence(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

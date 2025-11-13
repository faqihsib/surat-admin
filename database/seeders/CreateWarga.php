<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateWarga extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan 'id_ID' untuk data Indonesia
        $faker = Faker::create('id_ID');

        // Kita buat 50 data warga dummy
        foreach (range(1, 50) as $index) {
            DB::table('warga')->insert([
                'no_ktp' => $faker->unique()->numerify('14##############'),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'pekerjaan' => $faker->jobTitle(),
                'telp' => $faker->numerify('08##########'),
                'email' => $faker->unique()->safeEmail(),
            ]);
        }
    }
}

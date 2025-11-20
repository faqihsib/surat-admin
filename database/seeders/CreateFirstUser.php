<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'faqih@email.com',
            'password' => Hash::make('faqih123'),
        ]);

        $faker = Faker::create('id_ID'); // Gunakan locale Indonesia

        foreach (range(1, 100) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail, // Email harus unik
                'password' => Hash::make('password'), // Password default untuk dummy
            ]);
        }
    }
}

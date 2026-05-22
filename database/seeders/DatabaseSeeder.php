<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Contoh memanggil seeder lain yang sudah Anda buat
        $this->call([
        UserSeeder::class,
        HargaSeeder::class,
        ]);
    }
}

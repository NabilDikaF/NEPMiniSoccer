<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HargaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('harga')->insert([
            [
                'blok_waktu' => 'Pagi',
                'harga_reguler' => 100000.00,
                'harga_member' => 80000.00,
                'jam_mulai' => '06:00:00',
                'jam_selesai' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blok_waktu' => 'Siang',
                'harga_reguler' => 120000.00,
                'harga_member' => 100000.00,
                'jam_mulai' => '12:00:00',
                'jam_selesai' => '15:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blok_waktu' => 'Sore',
                'harga_reguler' => 150000.00,
                'harga_member' => 130000.00,
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blok_waktu' => 'Malam',
                'harga_reguler' => 180000.00,
                'harga_member' => 150000.00,
                'jam_mulai' => '18:00:00',
                'jam_selesai' => '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
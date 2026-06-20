<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HargaSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $dataHarga = [
            // ==========================================
            // BLOK PAGI (Rp 400.000 / Jam)
            // ==========================================
            ['blok_waktu' => 'Pagi', 'harga' => 400000.00, 'jam_mulai' => '06:00:00', 'jam_selesai' => '07:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Pagi', 'harga' => 400000.00, 'jam_mulai' => '07:00:00', 'jam_selesai' => '08:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Pagi', 'harga' => 400000.00, 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Pagi', 'harga' => 400000.00, 'jam_mulai' => '09:00:00', 'jam_selesai' => '10:00:00', 'created_at' => $now, 'updated_at' => $now],

            // ==========================================
            // BLOK SIANG (Rp 300.000 / Jam)
            // ==========================================
            ['blok_waktu' => 'Siang', 'harga' => 300000.00, 'jam_mulai' => '10:00:00', 'jam_selesai' => '11:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Siang', 'harga' => 300000.00, 'jam_mulai' => '11:00:00', 'jam_selesai' => '12:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Siang', 'harga' => 300000.00, 'jam_mulai' => '12:00:00', 'jam_selesai' => '13:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Siang', 'harga' => 300000.00, 'jam_mulai' => '13:00:00', 'jam_selesai' => '14:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Siang', 'harga' => 300000.00, 'jam_mulai' => '14:00:00', 'jam_selesai' => '15:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Siang', 'harga' => 300000.00, 'jam_mulai' => '15:00:00', 'jam_selesai' => '16:00:00', 'created_at' => $now, 'updated_at' => $now],

            // ==========================================
            // BLOK SORE (Rp 500.000 / Jam)
            // ==========================================
            ['blok_waktu' => 'Sore', 'harga' => 500000.00, 'jam_mulai' => '16:00:00', 'jam_selesai' => '17:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Sore', 'harga' => 500000.00, 'jam_mulai' => '17:00:00', 'jam_selesai' => '18:00:00', 'created_at' => $now, 'updated_at' => $now],

            // ==========================================
            // BLOK MALAM (Rp 600.000 / Jam)
            // ==========================================
            ['blok_waktu' => 'Malam', 'harga' => 600000.00, 'jam_mulai' => '18:00:00', 'jam_selesai' => '19:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Malam', 'harga' => 600000.00, 'jam_mulai' => '19:00:00', 'jam_selesai' => '20:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Malam', 'harga' => 600000.00, 'jam_mulai' => '20:00:00', 'jam_selesai' => '21:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Malam', 'harga' => 600000.00, 'jam_mulai' => '21:00:00', 'jam_selesai' => '22:00:00', 'created_at' => $now, 'updated_at' => $now],
            ['blok_waktu' => 'Malam', 'harga' => 600000.00, 'jam_mulai' => '22:00:00', 'jam_selesai' => '23:00:00', 'created_at' => $now, 'updated_at' => $now],
        ];

        // Memasukkan semua data array di atas ke tabel harga
        DB::table('harga')->insert($dataHarga);
    }
}
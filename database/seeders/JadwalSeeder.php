<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Harga;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua template harga/jam operasional
        $hargas = Harga::all();
        
        $dataJadwal = [];
        $now = Carbon::now();

        // Looping untuk membuat jadwal 1 minggu
        for ($i = 0; $i < 7; $i++) {
            $tanggal = Carbon::today()->addDays($i)->toDateString();

            foreach ($hargas as $harga) {
                $dataJadwal[] = [
                    'tanggal'       => $tanggal,
                    'id_harga'      => $harga->id_harga,
                    'status_jadwal' => 'Tersedia',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
            }
        }

        // Gunakan insertOrIgnore untuk mencegah error duplikasi jika seeder dijalankan ulang
        Jadwal::insertOrIgnore($dataJadwal);
    }
}
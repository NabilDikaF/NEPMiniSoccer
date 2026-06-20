<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'tanggal',
        'id_harga',
        'status_jadwal',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    // Jadwal ini pakai blok harga yang mana
    public function harga()
    {
        return $this->belongsTo(Harga::class, 'id_harga', 'id_harga');
    }

    public function detailBookings()
    {
        return $this->hasMany(DetailBooking::class, 'id_jadwal', 'id_jadwal');
    }

    /**
     * Membangkitkan jadwal secara otomatis untuk rentang tanggal tertentu
     * jika belum tersedia di database.
     */
    public static function generateForDateRange($startDate, $endDate)
    {
        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);
        
        $existingDates = self::whereBetween('tanggal', [$startDate, $endDate])
                             ->select('tanggal')
                             ->groupBy('tanggal')
                             ->pluck('tanggal')
                             ->map(function($date) {
                                 return \Carbon\Carbon::parse($date)->toDateString();
                             })->toArray();
                             
        $hargas = Harga::all();
        $dataJadwal = [];
        $now = \Carbon\Carbon::now();

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $dateString = $date->toDateString();
            
            if (!in_array($dateString, $existingDates)) {
                foreach ($hargas as $harga) {
                    $dataJadwal[] = [
                        'tanggal'       => $dateString,
                        'id_harga'      => $harga->id_harga,
                        'status_jadwal' => 'Tersedia',
                        'created_at'    => $now,
                        'updated_at'    => $now,
                    ];
                }
            }
        }

        if (!empty($dataJadwal)) {
            self::insertOrIgnore($dataJadwal);
        }
    }
}
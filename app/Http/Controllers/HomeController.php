<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        // 1. Ambil tanggal mulai dari URL (jika tidak ada, otomatis pakai hari ini)
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $start = Carbon::parse($startDate);
        
        // 2. Tanggal akhir selalu 6 hari setelah tanggal mulai (Total 7 hari)
        $endDate = $start->copy()->addDays(6)->toDateString();

        // 3. Hitung tanggal untuk tombol "Sebelumnya" dan "Selanjutnya" (Lompat 7 hari)
        $prevDate = $start->copy()->subDays(7)->toDateString();
        $nextDate = $start->copy()->addDays(7)->toDateString();

        // [AUTO-GENERATE] Pastikan jadwal untuk 7 hari tersebut sudah ada di database
        Jadwal::generateForDateRange($startDate, $endDate);

        // 4. Ambil jadwal dari database khusus untuk 7 hari tersebut
        $jadwals = Jadwal::with('harga')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'asc')
            ->get();

        // 5. Kelompokkan berdasarkan tanggal untuk menu Tab
        $jadwalsGrouped = $jadwals->groupBy('tanggal');

        return view('home', compact('jadwalsGrouped', 'startDate', 'endDate', 'prevDate', 'nextDate'));
    }
}
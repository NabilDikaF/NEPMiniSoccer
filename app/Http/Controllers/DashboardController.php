<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminNotification;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama admin dashboard.
     */
    public function dashboard()
    {
        // Notifikasi untuk modal (Semua)
        $allNotifications = AdminNotification::orderBy('created_at', 'desc')->get();

        // Notifikasi untuk Card (Max 20, prioritas: Belum Dibaca -> Urgent -> Terbaru)
        $recentNotifications = AdminNotification::orderBy('is_read', 'asc')
                                                ->orderByRaw('CASE WHEN is_read = 0 THEN is_urgent ELSE 0 END DESC')
                                                ->orderBy('created_at', 'desc')
                                                ->take(20)
                                                ->get();

        // Ambil pembayaran yang Menunggu Verifikasi tapi jadwal mainnya sudah lewat
        $expiredVerificationsQuery = \App\Models\Pembayaran::with(['booking.detailBookings.jadwal.harga', 'booking.user'])
            ->where('status_pembayaran', 'Menunggu Verifikasi')
            ->whereHas('booking', function ($q) {
                $q->where('status_booking', '!=', 'Dibatalkan');
            })->get();

        $expiredVerifications = $expiredVerificationsQuery->filter(function ($pembayaran) {
            return $pembayaran->booking && $pembayaran->booking->isPastPlayTime();
        });

        // 1. Total Pendapatan (Seminggu terakhir)
        $pemasukanKotor = \App\Models\Pembayaran::where('status_pembayaran', 'Valid')
            ->where('created_at', '>=', now()->subDays(7))
            ->sum('nominal_dibayar');

        $refunds = AdminNotification::where('tipe_notifikasi', 'Pengembalian Dana')
            ->where('created_at', '>=', now()->subDays(7))
            ->get();

        $totalRefund = 0;
        foreach ($refunds as $notif) {
            if (preg_match('/Rp\s*([\d\.]+)/', $notif->pesan, $matches)) {
                $totalRefund += (int) str_replace('.', '', $matches[1]);
            }
        }

        $totalPendapatan = $pemasukanKotor - $totalRefund;

        // 2. Pesanan Menunggu Verifikasi
        $pesananMenungguVerifikasi = \App\Models\Pembayaran::where('status_pembayaran', 'Menunggu Verifikasi')
            ->whereHas('booking', function ($q) {
                $q->where('status_booking', '!=', 'Dibatalkan');
                $q->whereHas('detailBookings.jadwal', function ($qJadwal) {
                    $qJadwal->whereDate('tanggal', '>=', \Carbon\Carbon::today());
                });
            })->count();

        // 3. Jadwal Hari Ini
        $jadwalHariIni = \App\Models\DetailBooking::whereHas('jadwal', function ($q) {
            $q->whereDate('tanggal', today());
        })->whereHas('booking', function ($q) {
            $q->whereIn('status_booking', ['Lunas', 'Confirmed', 'Selesai']);
        })->count();

        // 4. Analisis Jam Puncak
        $chartFilter = request('filter', 'seminggu');
        $startDate   = today();

        if ($chartFilter === 'hari_ini') {
            $startDate = today();
        } elseif ($chartFilter === 'seminggu') {
            $startDate = today()->subDays(6);
        } elseif ($chartFilter === 'sebulan') {
            $startDate = today()->subDays(29);
        }

        $peakHoursData = \App\Models\DetailBooking::with('jadwal.harga')
            ->whereHas('booking', fn($q) => $q->where('status_booking', '!=', 'Dibatalkan'))
            ->whereHas('jadwal', fn($q) => $q->whereBetween('tanggal', [$startDate, today()]))
            ->get()
            ->groupBy(fn($item) => substr($item->jadwal->harga->jam_mulai, 0, 5))
            ->map(fn($group) => $group->count());

        $labels = [];
        $data   = [];
        for ($i = 6; $i <= 23; $i++) {
            $jam      = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
            $labels[] = $jam;
            $data[]   = $peakHoursData->get($jam, 0);
        }

        if (request()->ajax()) {
            return response()->json(['labels' => $labels, 'data' => $data]);
        }

        return view('admin-dashboard', compact(
            'allNotifications', 'recentNotifications', 'expiredVerifications',
            'totalPendapatan', 'pesananMenungguVerifikasi', 'jadwalHariIni',
            'labels', 'data'
        ));
    }

    /**
     * Menandai notifikasi sebagai sudah dibaca.
     */
    public function markNotificationRead(Request $request, $id)
    {
        $notif = AdminNotification::findOrFail($id);
        $notif->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}

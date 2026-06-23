<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\AdminNotification;

class LaporanController extends Controller
{
    /**
     * Menghitung total pendapatan bersih (pemasukan - refund) dalam rentang waktu.
     */
    private function calculateRevenue($startDate, $endDate): float
    {
        $pemasukan = Pembayaran::where('status_pembayaran', 'Valid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('nominal_dibayar');

        $refunds = AdminNotification::where('tipe_notifikasi', 'Pengembalian Dana')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalRefund = 0;
        foreach ($refunds as $notif) {
            if (preg_match('/Rp\s*([\d\.]+)/', $notif->pesan, $matches)) {
                $totalRefund += (int) str_replace('.', '', $matches[1]);
            }
        }

        return $pemasukan - $totalRefund;
    }

    /**
     * Membangun data transaksi gabungan (pemasukan + pengeluaran/refund) berdasarkan filter.
     */
    private function buildTransactionData(?string $start, ?string $end): array
    {
        $pemasukanQuery  = Pembayaran::where('status_pembayaran', 'Valid');
        $pengeluaranQuery = AdminNotification::where('tipe_notifikasi', 'Pengembalian Dana');

        if ($start && $end) {
            $pemasukanQuery->whereBetween('created_at',  [$start . ' 00:00:00', $end . ' 23:59:59']);
            $pengeluaranQuery->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        $pemasukanList  = $pemasukanQuery->get();
        $pengeluaranList = $pengeluaranQuery->get();

        $totalPemasukan  = 0;
        $totalPengeluaran = 0;
        $transactions    = [];

        foreach ($pemasukanList as $p) {
            $totalPemasukan += $p->nominal_dibayar;
            $transactions[] = [
                'tanggal'         => $p->created_at->format('Y-m-d H:i:s'),
                'tanggal_display' => $p->created_at->translatedFormat('d M Y, H:i'),
                'tipe'            => 'Masuk',
                'deskripsi'       => 'Pembayaran ' . $p->jenis_pembayaran . ' (Order #' . $p->id_booking . ')',
                'nominal'         => $p->nominal_dibayar,
            ];
        }

        foreach ($pengeluaranList as $notif) {
            $nominal = 0;
            if (preg_match('/Rp\s*([\d\.]+)/', $notif->pesan, $matches)) {
                $nominal = (int) str_replace('.', '', $matches[1]);
            }
            $totalPengeluaran += $nominal;
            $transactions[] = [
                'tanggal'         => $notif->created_at->format('Y-m-d H:i:s'),
                'tanggal_display' => $notif->created_at->translatedFormat('d M Y, H:i'),
                'tipe'            => 'Keluar',
                'deskripsi'       => 'Refund (' . $notif->judul . ')',
                'nominal'         => $nominal,
            ];
        }

        // Urutkan berdasarkan tanggal terbaru
        usort($transactions, fn($a, $b) => strtotime($b['tanggal']) - strtotime($a['tanggal']));

        return compact('totalPemasukan', 'totalPengeluaran', 'transactions');
    }

    /**
     * Menampilkan halaman laporan admin.
     */
    public function laporan(Request $request)
    {
        // Mingguan
        $startMingguIni  = now()->startOfWeek();
        $endMingguIni    = now()->endOfWeek();
        $startMingguLalu = now()->subWeek()->startOfWeek();
        $endMingguLalu   = now()->subWeek()->endOfWeek();

        $pendapatanMingguIni  = $this->calculateRevenue($startMingguIni, $endMingguIni);
        $pendapatanMingguLalu = $this->calculateRevenue($startMingguLalu, $endMingguLalu);

        // Bulanan
        $startBulanIni  = now()->startOfMonth();
        $endBulanIni    = now()->endOfMonth();
        $startBulanLalu = now()->subMonth()->startOfMonth();
        $endBulanLalu   = now()->subMonth()->endOfMonth();

        $pendapatanBulanIni  = $this->calculateRevenue($startBulanIni, $endBulanIni);
        $pendapatanBulanLalu = $this->calculateRevenue($startBulanLalu, $endBulanLalu);

        if ($request->ajax()) {
            $compare = $request->get('compare', 'mingguan');
            if ($compare === 'bulanan') {
                return response()->json([
                    'current'      => $pendapatanBulanIni,
                    'past'         => $pendapatanBulanLalu,
                    'currentLabel' => 'Bulan Ini',
                    'pastLabel'    => 'Bulan Lalu',
                ]);
            }
            return response()->json([
                'current'      => $pendapatanMingguIni,
                'past'         => $pendapatanMingguLalu,
                'currentLabel' => 'Minggu Ini',
                'pastLabel'    => 'Minggu Lalu',
            ]);
        }

        return view('admin-laporan', compact(
            'pendapatanMingguIni', 'pendapatanMingguLalu',
            'pendapatanBulanIni', 'pendapatanBulanLalu'
        ));
    }

    /**
     * Halaman cetak laporan perbandingan pendapatan.
     */
    public function cetakPerbandingan(Request $request)
    {
        $compare = $request->get('compare', 'mingguan');

        if ($compare === 'bulanan') {
            $startIni  = now()->startOfMonth();
            $endIni    = now()->endOfMonth();
            $startLalu = now()->subMonth()->startOfMonth();
            $endLalu   = now()->subMonth()->endOfMonth();
            $lblIni    = 'Bulan Ini (' . $startIni->translatedFormat('F Y') . ')';
            $lblLalu   = 'Bulan Lalu (' . $startLalu->translatedFormat('F Y') . ')';
        } else {
            $startIni  = now()->startOfWeek();
            $endIni    = now()->endOfWeek();
            $startLalu = now()->subWeek()->startOfWeek();
            $endLalu   = now()->subWeek()->endOfWeek();
            $lblIni    = 'Minggu Ini (' . $startIni->translatedFormat('d M') . ' - ' . $endIni->translatedFormat('d M Y') . ')';
            $lblLalu   = 'Minggu Lalu (' . $startLalu->translatedFormat('d M') . ' - ' . $endLalu->translatedFormat('d M Y') . ')';
        }

        $pendapatanIni  = $this->calculateRevenue($startIni, $endIni);
        $pendapatanLalu = $this->calculateRevenue($startLalu, $endLalu);

        return view('admin-cetak-perbandingan', compact(
            'compare', 'pendapatanIni', 'pendapatanLalu', 'lblIni', 'lblLalu'
        ));
    }

    /**
     * AJAX endpoint untuk data transaksi pendapatan.
     */
    public function getPendapatanData(Request $request)
    {
        $start = $request->get('start_date');
        $end   = $request->get('end_date');

        $data = $this->buildTransactionData($start, $end);

        return response()->json([
            'total_masuk'  => $data['totalPemasukan'],
            'total_keluar' => $data['totalPengeluaran'],
            'total_bersih' => $data['totalPemasukan'] - $data['totalPengeluaran'],
            'transactions' => $data['transactions'],
        ]);
    }

    /**
     * Halaman cetak laporan rincian pendapatan.
     */
    public function cetakPendapatan(Request $request)
    {
        $start  = $request->get('start_date');
        $end    = $request->get('end_date');
        $filter = $request->get('filter', 'semua');

        $data         = $this->buildTransactionData($start, $end);
        $totalMasuk   = $data['totalPemasukan'];
        $totalKeluar  = $data['totalPengeluaran'];
        $totalBersih  = $totalMasuk - $totalKeluar;
        $transactions = $data['transactions'];

        // Filter berdasarkan dropdown
        if ($filter === 'masuk') {
            $transactions = array_filter($transactions, fn($t) => $t['tipe'] === 'Masuk');
        } elseif ($filter === 'keluar') {
            $transactions = array_filter($transactions, fn($t) => $t['tipe'] === 'Keluar');
        }

        return view('admin-cetak-pendapatan', compact(
            'start', 'end', 'filter', 'totalMasuk', 'totalKeluar', 'totalBersih', 'transactions'
        ));
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Jadwal;
use App\Models\AdminNotification;

class CancelExpiredBookings extends Command
{
    // Nama perintah yang akan dipanggil oleh sistem
    protected $signature = 'booking:cancel-expired';

    // Deskripsi perintah
    protected $description = 'Membatalkan booking yang belum dibayar setelah 15 menit';

    public function handle()
    {
        // Cari semua booking yang statusnya 'Menunggu Pembayaran' 
        // DAN waktu pembuatannya sudah lebih dari 15 menit yang lalu
        $expiredBookings = Booking::with(['detailBookings', 'user'])
            ->where('status_booking', 'Menunggu Pembayaran')
            ->where('updated_at', '<=', now()->subMinutes(15))
            ->get();

        foreach ($expiredBookings as $booking) {
            // 1. Ubah status booking menjadi dibatalkan
            $booking->update(['status_booking' => 'Dibatalkan']);

            // 2. Buka kembali gembok lapangan agar bisa dipesan orang lain
            foreach ($booking->detailBookings as $detail) {
                Jadwal::where('id_jadwal', $detail->id_jadwal)
                      ->update(['status_jadwal' => 'Tersedia']);
            }

            // 3. Tambahkan log ke riwayat aktivitas admin
            AdminNotification::create([
                'tipe_notifikasi' => 'Batal Otomatis',
                'pesan' => "Pesanan #{$booking->id_booking} dari " . ($booking->user->name ?? 'Pengguna') . " dibatalkan otomatis karena melewati batas waktu 15 menit.",
                'id_booking' => $booking->id_booking,
                'is_read' => false,
                'is_urgent' => false,
            ]);
        }

        // Cek pesanan yang 'Menunggu Verifikasi' dan jadwal mainnya sudah lewat
        $unverifiedBookings = Booking::with(['detailBookings.jadwal.harga', 'user'])
            ->where('status_booking', 'Menunggu Verifikasi')
            ->get();

        $expiredUnverifiedCount = 0;
        foreach ($unverifiedBookings as $booking) {
            if ($booking->isPastPlayTime()) {
                // Cek apakah notifikasi untuk pesanan ini dengan tipe 'Verifikasi Lewat Waktu' sudah ada
                $existingNotif = AdminNotification::where('id_booking', $booking->id_booking)
                    ->where('tipe_notifikasi', 'Verifikasi Lewat Waktu')
                    ->first();

                if (!$existingNotif) {
                    AdminNotification::create([
                        'tipe_notifikasi' => 'Verifikasi Lewat Waktu',
                        'pesan' => "PERHATIAN: Pesanan #{$booking->id_booking} dari " . ($booking->user->name ?? 'Unknown') . " berstatus Menunggu Verifikasi namun jadwal bermainnya telah lewat. Harap segera ditindaklanjuti!",
                        'id_booking' => $booking->id_booking,
                        'is_urgent' => true
                    ]);
                    $expiredUnverifiedCount++;
                }
            }
        }

        // Cek pesanan yang 'Half Paid' (gagal melunasi DP sebelum jadwal target)
        $halfPaidBookings = Booking::with(['detailBookings.jadwal.harga', 'user'])
            ->where('status_booking', 'Half Paid')
            ->get();

        $canceledHalfPaidCount = 0;
        foreach ($halfPaidBookings as $booking) {
            // Dapatkan semua jadwal untuk pesanan ini dan sortir berdasarkan tanggal & waktu mulai
            $jadwals = $booking->detailBookings->map(function ($detail) {
                return $detail->jadwal;
            })->filter(function ($jadwal) {
                return $jadwal && $jadwal->harga;
            })->sortBy(function ($jadwal) {
                $tanggalStr = $jadwal->tanggal instanceof \Carbon\Carbon ? $jadwal->tanggal->format('Y-m-d') : substr($jadwal->tanggal, 0, 10);
                return $tanggalStr . ' ' . $jadwal->harga->jam_mulai;
            })->values();

            if ($jadwals->isEmpty()) continue;

            $deadlineIndex = ($booking->tipe_booking === 'Member') ? 2 : 0;
            
            // Fallback jika karena alasan tertentu jumlah jadwal kurang dari target index
            if (!isset($jadwals[$deadlineIndex])) {
                $deadlineIndex = $jadwals->count() - 1;
            }

            $targetJadwal = $jadwals[$deadlineIndex];
            $tanggalStr = $targetJadwal->tanggal instanceof \Carbon\Carbon ? $targetJadwal->tanggal->format('Y-m-d') : substr($targetJadwal->tanggal, 0, 10);
            $deadlineTime = \Carbon\Carbon::parse($tanggalStr . ' ' . $targetJadwal->harga->jam_mulai);

            // Jika waktu saat ini sudah mencapai atau melewati tenggat waktu pelunasan
            if (now()->greaterThanOrEqualTo($deadlineTime)) {
                // 1. Batalkan pesanan
                $booking->update(['status_booking' => 'Dibatalkan']);

                // 2. Bebaskan sisa jadwal yang masih di masa depan
                foreach ($jadwals as $jadwal) {
                    $jadwalTanggalStr = $jadwal->tanggal instanceof \Carbon\Carbon ? $jadwal->tanggal->format('Y-m-d') : substr($jadwal->tanggal, 0, 10);
                    $jadwalWaktuMulai = \Carbon\Carbon::parse($jadwalTanggalStr . ' ' . $jadwal->harga->jam_mulai);
                    
                    if ($jadwalWaktuMulai->greaterThan(now())) {
                        Jadwal::where('id_jadwal', $jadwal->id_jadwal)->update(['status_jadwal' => 'Tersedia']);
                    }
                }

                // 3. Tambahkan log ke riwayat aktivitas admin
                AdminNotification::create([
                    'tipe_notifikasi' => 'Batal Otomatis',
                    'pesan' => "Pesanan #{$booking->id_booking} dari " . ($booking->user->name ?? 'Pengguna') . " dibatalkan otomatis karena gagal melunasi pembayaran sebelum tenggat waktu (DP Hangus).",
                    'id_booking' => $booking->id_booking,
                    'is_read' => false,
                    'is_urgent' => false,
                ]);

                $canceledHalfPaidCount++;
            }
        }

        // Tampilkan pesan di terminal (opsional)
        $this->info(count($expiredBookings) . ' booking kadaluarsa berhasil dibatalkan.');
        $this->info($canceledHalfPaidCount . ' pesanan DP hangus berhasil dibatalkan.');
        $this->info($expiredUnverifiedCount . ' notifikasi jadwal lewat waktu dibuat.');
    }
}
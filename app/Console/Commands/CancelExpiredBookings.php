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

        // Tampilkan pesan di terminal (opsional)
        $this->info(count($expiredBookings) . ' booking kadaluarsa berhasil dibatalkan.');
    }
}
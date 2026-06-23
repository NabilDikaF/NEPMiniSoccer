<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AdminNotification;

class BookingController extends Controller
{
    /**
     * Menampilkan form / halaman untuk memilih jadwal
     */
    public function booking()
    {
        // [AUTO-GENERATE] Pastikan jadwal untuk 30 hari ke depan sudah ada di database
        $startDate = now()->toDateString();
        $endDate = now()->addDays(30)->toDateString();
        Jadwal::generateForDateRange($startDate, $endDate);

        // Ambil jadwal mulai hari ini ke depan (termasuk yang tidak tersedia agar dirender sebagai disable di view)
        $jadwals = Jadwal::with('harga')
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('bookingpage', compact('jadwals'));
    }

    /**
     * Memproses data pesanan yang dikirim dari form (Penyimpanan Data)
     */
    public function store_booking(Request $request)
    {
        // 1. Validasi input (asumsi pelanggan bisa mencentang lebih dari 1 jadwal)
        $rules = [
            'id_jadwal'   => ['required', 'array'],
            'id_jadwal.*' => ['exists:jadwal,id_jadwal'],
            'tipe_booking'=> ['required', 'in:Reguler,Member'],
        ];

        // Nama tim wajib diisi jika ini adalah booking baru (bukan reschedule)
        if (!session()->has('reschedule_booking_id')) {
            $rules['nama_tim'] = ['required', 'string', 'max:255'];
        }

        $request->validate($rules, [
            'nama_tim.required' => 'Nama tim wajib diisi.'
        ]);

        // Validasi Ekstra Keamanan (Back-End) untuk aturan tipe_booking
        $tipeBookingToProcess = $request->tipe_booking;
        if (session()->has('reschedule_booking_id')) {
            $oldBooking = \App\Models\Booking::find(session('reschedule_booking_id'));
            if ($oldBooking) {
                $tipeBookingToProcess = $oldBooking->tipe_booking;
            }
        }

        // Hitung jumlah HARI (tanggal) unik yang dipilih
        $uniqueDatesCount = \App\Models\Jadwal::whereIn('id_jadwal', $request->id_jadwal)
                                ->distinct()
                                ->count('tanggal');

        if ($tipeBookingToProcess === 'Member' && $uniqueDatesCount < 4) {
            return back()->with('error', 'Validasi Gagal (Keamanan): Tipe pesanan Member wajib memilih jadwal di minimal 4 hari yang berbeda.')->withInput();
        }
        
        if ($tipeBookingToProcess === 'Reguler' && $uniqueDatesCount > 1) {
            return back()->with('error', 'Validasi Gagal (Keamanan): Pesanan Reguler hanya dapat memilih jadwal pada maksimal 1 hari yang sama.')->withInput();
        }

        if (session()->has('reschedule_booking_id')) {
            $oldBooking = \App\Models\Booking::with('detailBookings')->find(session('reschedule_booking_id'));
            
            if ($oldBooking) {
                
                // 1. CARI TAHU NAMA INPUT JADWAL ANDA
                $jadwalBaruYangDipilih = $request->input('id_jadwal'); 

                // Validasi ekstra agar tidak error (null) jika user lupa menceklis jadwal
                if (!$jadwalBaruYangDipilih || !is_array($jadwalBaruYangDipilih)) {
                    return back()->with('error', 'Silakan pilih minimal 1 slot waktu jadwal yang baru.');
                }

                // 2. Transaksi Database untuk Reschedule
                DB::beginTransaction();
                try {
                    // Ambil jadwal baru dan KUNCI
                    $jadwalTerpilih = \App\Models\Jadwal::with('harga')
                                        ->whereIn('id_jadwal', $jadwalBaruYangDipilih)
                                        ->lockForUpdate()
                                        ->get();

                    $newSubtotal = 0;
                    foreach ($jadwalTerpilih as $jadwal) {
                        if ($jadwal->status_jadwal !== 'Tersedia') {
                            throw new \Exception("Maaf, lapangan pada tanggal {$jadwal->tanggal} baru saja dipesan orang lain.");
                        }
                        if (!$jadwal->harga->is_active) {
                            throw new \Exception("Maaf, lapangan pada tanggal {$jadwal->tanggal} saat ini sedang ditutup/maintenance.");
                        }

                        $tanggalStr = $jadwal->tanggal instanceof \Carbon\Carbon ? $jadwal->tanggal->format('Y-m-d') : substr($jadwal->tanggal, 0, 10);
                        $jadwalTime = \Carbon\Carbon::parse($tanggalStr . ' ' . $jadwal->harga->jam_mulai);
                        if ($jadwalTime->isPast()) {
                            $tglHanya = \Carbon\Carbon::parse($tanggalStr)->translatedFormat('d M Y');
                            throw new \Exception("Maaf, jadwal pada {$tglHanya} jam {$jadwal->harga->jam_mulai} sudah lewat waktu.");
                        }

                        $newSubtotal += $jadwal->harga->harga;
                    }

                    $newDiscount = ($oldBooking->tipe_booking === 'Member') ? ($newSubtotal * 0.15) : 0;
                    $newTax = count($jadwalTerpilih) > 0 ? 5000 : 0;
                    $newTotalTagihan = $newSubtotal - $newDiscount + $newTax;

                    // 3. Lepaskan/Kosongkan jadwal yang LAMA
                    $oldJadwalIds = $oldBooking->detailBookings->pluck('id_jadwal');
                    \App\Models\Jadwal::whereIn('id_jadwal', $oldJadwalIds)->update(['status_jadwal' => 'Tersedia']);
                    \App\Models\DetailBooking::where('id_booking', $oldBooking->id_booking)->delete();

                    // 4. Masukkan jadwal yang BARU ke booking ini
                    foreach ($jadwalTerpilih as $jadwal) {
                        \App\Models\DetailBooking::create([
                            'id_booking'  => $oldBooking->id_booking, 
                            'id_jadwal'   => $jadwal->id_jadwal,
                            'harga_final' => $jadwal->harga->harga,
                        ]);
                        // Kunci jadwal baru
                        $jadwal->update(['status_jadwal' => 'Terbooking']); 
                    }

                    // 5. Bandingkan Harga Lama vs Harga Baru
                    if ($newTotalTagihan > $oldBooking->total_tagihan) {
                        // Jika jadwal baru LEBIH MAHAL -> Suruh bayar selisihnya
                        $oldBooking->update([
                            'total_tagihan'  => $newTotalTagihan,
                            'status_booking' => 'Menunggu Pembayaran'
                        ]);
                        $pesan = "Reschedule berhasil! Jadwal baru Anda memiliki total harga yang lebih besar. Silakan lakukan pembayaran pelunasan kekurangannya.";
                    } else {
                        // Jika harga SAMA (atau lebih murah) -> Biarkan status seperti sebelumnya
                        $oldBooking->update([
                            'total_tagihan'  => $newTotalTagihan,
                        ]);
                        $pesan = "Reschedule berhasil diproses! Jadwal Anda telah diperbarui tanpa tambahan biaya.";
                    }

                    \App\Models\AdminNotification::create([
                        'tipe_notifikasi' => 'Reschedule',
                        'pesan' => "Pelanggan " . \Illuminate\Support\Facades\Auth::user()->name . " telah mengubah jadwal untuk pesanan #{$oldBooking->id_booking}.",
                        'id_booking' => $oldBooking->id_booking,
                        'is_urgent' => false
                    ]);

                    DB::commit();
                    
                    // 6. Hapus sesi agar kembali normal
                    session()->forget('reschedule_booking_id');

                    return redirect()->route('mybooking')->with('success', $pesan);

                } catch (\Exception $e) {
                    DB::rollBack();
                    return back()->with('error', $e->getMessage());
                }
            }
        }
        // 2. Mulai Database Transaction (Sangat penting untuk mencegah double-booking!)
        DB::beginTransaction();

        try {
            $subtotal = 0;
            
            // Ambil data jadwal yang dipilih user dan "kunci" datanya sementara waktu
            $jadwalTerpilih = Jadwal::with('harga')
                                ->whereIn('id_jadwal', $request->id_jadwal)
                                ->lockForUpdate() // Mencegah user lain mengambil jadwal ini di detik yang sama
                                ->get();

            // 3. Pengecekan ulang & Hitung Total
            foreach ($jadwalTerpilih as $jadwal) {
                if ($jadwal->status_jadwal !== 'Tersedia') {
                    // Jika keduluan orang lain sedetik yang lalu, batalkan semua proses
                    throw new \Exception("Maaf, lapangan pada tanggal {$jadwal->tanggal} baru saja dipesan orang lain.");
                }
                if (!$jadwal->harga->is_active) {
                    throw new \Exception("Maaf, lapangan pada tanggal {$jadwal->tanggal} saat ini sedang ditutup/maintenance.");
                }

                $tanggalStr = $jadwal->tanggal instanceof \Carbon\Carbon ? $jadwal->tanggal->format('Y-m-d') : substr($jadwal->tanggal, 0, 10);
                $jadwalTime = \Carbon\Carbon::parse($tanggalStr . ' ' . $jadwal->harga->jam_mulai);
                if ($jadwalTime->isPast()) {
                    $tglHanya = \Carbon\Carbon::parse($tanggalStr)->translatedFormat('d M Y');
                    throw new \Exception("Maaf, jadwal pada {$tglHanya} jam {$jadwal->harga->jam_mulai} sudah lewat waktu.");
                }

                $subtotal += $jadwal->harga->harga;
            }

            $discount = ($request->tipe_booking === 'Member') ? ($subtotal * 0.15) : 0;
            $tax = count($jadwalTerpilih) > 0 ? 5000 : 0;
            $totalTagihan = $subtotal - $discount + $tax;

            // 4. Simpan ke tabel `booking` (id_booking akan otomatis dibuat oleh boot() di Model)
            $booking = Booking::create([
                'id_user'        => Auth::id(),
                'tipe_booking'   => $request->tipe_booking,
                'nama_tim'       => $request->nama_tim,
                'status_booking' => 'Menunggu Pembayaran',
                'total_tagihan'  => $totalTagihan,
            ]);

            // 5. Simpan ke tabel `detail_booking` & Ubah status `jadwal`
            foreach ($jadwalTerpilih as $jadwal) {
                DetailBooking::create([
                    'id_booking'  => $booking->id_booking,
                    'id_jadwal'   => $jadwal->id_jadwal,
                    'harga_final' => $jadwal->harga->harga, // Mengunci harga saat itu
                ]);

                // Ubah status jadwal agar hilang dari kalender publik
                $jadwal->update([
                    'status_jadwal' => 'Pending' 
                ]);
            }

            AdminNotification::create([
                'tipe_notifikasi' => 'Booking Baru',
                'pesan' => "Pelanggan " . Auth::user()->name . " membuat pesanan baru #{$booking->id_booking} dan sedang menunggu pembayaran.",
                'id_booking' => $booking->id_booking,
                'is_urgent' => false
            ]);

            // 6. Jika semua proses di atas sukses tanpa error, simpan permanen (Commit)
            DB::commit();

            return redirect()->route('mybooking')->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            // Jika ada yang error/gagal, batalkan semua inputan ke database (Rollback)
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Menampilkan daftar pesanan milik pelanggan yang sedang login
     */
    public function mybooking()
    {
        // Auto-update status Lunas menjadi Selesai jika waktu sudah berlalu
        \App\Models\Booking::updateStatusSelesai(Auth::id());

        // Ambil data booking milik user yang sedang login, beserta detail jadwal, harga, dan pembayarannya
        $bookings = Booking::with(['detailBookings.jadwal.harga', 'pembayaranTerakhir'])
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('statusbooking', compact('bookings'));
    }

    /**
     * Memproses Pembatalan (Cancel) oleh Pelanggan
     */
    public function cancelBooking(Request $request, $id_booking)
    {
        $booking = \App\Models\Booking::with('detailBookings.jadwal')->where('id_booking', $id_booking)
                                      ->where('id_user', \Illuminate\Support\Facades\Auth::id())
                                      ->firstOrFail();

        // 1. Cari tanggal bermain paling awal
        $firstDetail = $booking->detailBookings->sortBy('jadwal.tanggal')->first();
        if(!$firstDetail) return back()->with('error', 'Data jadwal tidak ditemukan.');

        $jadwalMulai = \Carbon\Carbon::parse($firstDetail->jadwal->tanggal)->startOfDay();
        $hariIni = \Carbon\Carbon::now()->startOfDay();
        
        // 2. Hitung selisih hari (H-x)
        $selisihHari = $hariIni->diffInDays($jadwalMulai, false);

        // 3. Logika Denda H-2
        $pesanRefund = "";
        $totalDibayar = \App\Models\Pembayaran::where('id_booking', $booking->id_booking)->where('status_pembayaran', 'Valid')->sum('nominal_dibayar');
        $uangKembali = 0;

        if ($totalDibayar > 0) {
            if ($selisihHari <= 2) {
                // Jika dibatalkan pada H-2 atau mepet
                if ($booking->status_booking == 'Half Paid') {
                    $pesanRefund = "Karena dibatalkan pada H-2, uang DP Anda hangus.";
                    $uangKembali = 0;
                } else {
                    $pengembalian = $totalDibayar / 2;
                    $pesanRefund = "Karena dibatalkan pada H-2, pengembalian dana hanya 50% (Rp " . number_format($pengembalian, 0, ',', '.') . ").";
                    $uangKembali = $pengembalian;
                }
            } else {
                // Jika dibatalkan sebelum H-2 (H-3, H-4, dst)
                $pesanRefund = "Dibatalkan tepat waktu. Pengembalian dana penuh 100% (Rp " . number_format($totalDibayar, 0, ',', '.') . ").";
                $uangKembali = $totalDibayar;
            }
        }

        // 4. Update status booking & bebaskan lapangan dalam Transaksi
        DB::beginTransaction();
        try {
            $booking->update(['status_booking' => 'Dibatalkan']);
            
            foreach($booking->detailBookings as $detail) {
                \App\Models\Jadwal::where('id_jadwal', $detail->id_jadwal)->update(['status_jadwal' => 'Tersedia']);
            }

            // 5. Otomatis tolak pembayaran yang masih menggantung
            \App\Models\Pembayaran::where('id_booking', $booking->id_booking)
                ->where('status_pembayaran', 'Menunggu Verifikasi')
                ->update([
                    'status_pembayaran' => 'Ditolak',
                    'catatan_admin' => 'Otomatis ditolak sistem karena pesanan dibatalkan pelanggan.'
                ]);

            if ($uangKembali > 0) {
                $isUrgent = true;
                $tipe = 'Pengembalian Dana';
                $pesanNotif = "Pelanggan " . Auth::user()->name . " membatalkan booking #{$booking->id_booking}. Dana perlu dikembalikan (Rp " . number_format($uangKembali, 0, ',', '.') . ").";
            } else {
                $isUrgent = false;
                $tipe = 'Booking Dibatalkan';
                $pesanNotif = "Pelanggan " . Auth::user()->name . " membatalkan booking #{$booking->id_booking}.";
            }

            \App\Models\AdminNotification::create([
                'tipe_notifikasi' => $tipe,
                'pesan' => $pesanNotif,
                'id_booking' => $booking->id_booking,
                'is_urgent' => $isUrgent
            ]);

            DB::commit();

            $successMsg = 'Booking berhasil dibatalkan.';
            if ($pesanRefund) {
                $successMsg .= ' ' . $pesanRefund;
            }
            
            return back()->with('success', $successMsg);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Memproses Perubahan Jadwal (Reschedule) - Tahap Inisiasi
     */
    public function rescheduleBooking(Request $request, $id_booking)
    {
        $booking = \App\Models\Booking::with('detailBookings.jadwal')->where('id_booking', $id_booking)
                                      ->where('id_user', \Illuminate\Support\Facades\Auth::id())
                                      ->firstOrFail();

        $firstDetail = $booking->detailBookings->sortBy('jadwal.tanggal')->first();
        $jadwalMulai = \Carbon\Carbon::parse($firstDetail->jadwal->tanggal)->startOfDay();
        $hariIni = \Carbon\Carbon::now()->startOfDay();

        $selisihHari = $hariIni->diffInDays($jadwalMulai, false);

        // Validasi H-3
        if ($selisihHari <= 3) {
            return back()->with('error', 'Permintaan Reschedule DITOLAK. Reschedule hanya dapat dilakukan maksimal H-3 sebelum jadwal bermain.');
        }

        // SIMPAN ID BOOKING KE SESSION UNTUK DIBAWA KE HALAMAN PEMILIHAN JADWAL
        session(['reschedule_booking_id' => $booking->id_booking]);

        // Arahkan pelanggan ke halaman pemilihan jadwal (Sesuaikan nama route halaman booking Anda)
        return redirect()->route('booking')->with('success', 'Silakan pilih tanggal dan jam yang baru untuk mengganti jadwal Anda.');
    }

    public function cancelRescheduleSession()
    {
        // Hapus ingatan sistem bahwa user sedang melakukan reschedule
        session()->forget('reschedule_booking_id');
        
        // Kembalikan ke halaman mybooking
        return redirect()->route('mybooking')->with('success', 'Mode Reschedule dibatalkan. Jadwal lama Anda tetap aman dan tidak berubah.');
    }
}
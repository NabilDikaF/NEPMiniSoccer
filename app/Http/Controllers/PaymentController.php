<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminNotification;

class PaymentController extends Controller
{
    public function payment($id_booking)
    {
        $booking = Booking::with('detailBookings.jadwal.harga')
                          ->where('id_booking', $id_booking)
                          ->where('id_user', Auth::id())
                          ->firstOrFail();

        return view('paymentpage', compact('booking'));
    }

    /**
     * Memproses upload bukti transfer dari pelanggan
     */
    /**
     * Memproses upload bukti transfer dari pelanggan
     */
    public function storePayment(Request $request, $id_booking)
    {
        
        $booking = Booking::with('detailBookings')->where('id_booking', $id_booking)
                          ->where('id_user', Auth::id())
                          ->firstOrFail();

        // 1. Validasi Input sesuai dengan atribut 'name' di HTML
        $request->validate([
            'payment_type'     => ['required', 'in:dp,full'],
            'bukti_pembayaran' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5120'], // Batas 5MB agar aman untuk foto HP
        ], [
            'bukti_pembayaran.required' => 'Silakan pilih file bukti transfer terlebih dahulu.',
            'bukti_pembayaran.image'    => 'File harus berupa gambar (JPG, JPEG, atau PNG).'
        ]);

        DB::beginTransaction();

        try {
            // 2. Simpan file gambar ke folder public/bukti_transfer
            $path = $request->file('bukti_pembayaran')->store('bukti_transfer', 'public');

            // 3. Hitung nominal secara aman di server berdasarkan pilihan DP/Full
            $sudahValid = $booking->pembayaran()->where('status_pembayaran', 'Valid')->sum('nominal_dibayar');
            
            if ($booking->status_booking === 'Half Paid') {
                // Jika statusnya sudah DP, maka pembayaran ini otomatis dianggap Pelunasan
                $nominalDibayar = $booking->total_tagihan - $sudahValid;
                $jenisPembayaran = 'Pelunasan';
            } else {
                // Jika pembayaran pertama kali
                $nominalDibayar = ($request->payment_type === 'dp') ? ($booking->total_tagihan / 2) : $booking->total_tagihan;
                $jenisPembayaran = ($request->payment_type === 'dp') ? 'DP' : 'Lunas';
            }

            // Hitung sisa tagihan akhir
            $sisaTagihan = $booking->total_tagihan - ($sudahValid + $nominalDibayar);
            if ($sisaTagihan < 0) {
                $sisaTagihan = 0;
            }

            // 4. Masukkan data ke tabel pembayaran (menyesuaikan nama kolom database Anda)
            Pembayaran::create([
                'id_booking'        => $booking->id_booking,
                'jenis_pembayaran'  => $jenisPembayaran,
                'nominal_dibayar'   => $nominalDibayar,
                'sisa_tagihan'      => $sisaTagihan,
                'bukti_transfer'    => $path, // Menyimpan path gambar
                'status_pembayaran' => 'Menunggu Verifikasi',
            ]);

            // 5. Ubah status di tabel booking
            $booking->update([
                'status_booking' => 'Menunggu Verifikasi'
            ]);

            AdminNotification::create([
                'tipe_notifikasi' => 'Menunggu Verifikasi',
                'pesan' => "Pelanggan " . Auth::user()->name . " mengunggah bukti pembayaran untuk pesanan #{$booking->id_booking}.",
                'id_booking' => $booking->id_booking,
                'is_urgent' => false
            ]);

            DB::commit();
            
            // 6. Sukses! Redirect ke rute mybooking
            return redirect()->route('mybooking')->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu verifikasi Admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data pembayaran: ' . $e->getMessage());
        }
    }


    // ==========================================
    // SISI ADMIN
    // ==========================================

    /**
     * Menampilkan daftar pembayaran yang masuk ke Admin
     */
    public function indexAdmin(Request $request)
    {
        // 1. Hitung statistik untuk kotak bagian atas
        $pendingCount = Pembayaran::where('status_pembayaran', 'Menunggu Verifikasi')->count();
        $approvedTodayCount = Pembayaran::where('status_pembayaran', 'Valid')
                                        ->whereDate('updated_at', \Carbon\Carbon::today())
                                        ->count();
        $rejectedCount = Pembayaran::where('status_pembayaran', 'Ditolak')->count();

        // 2. Query dasar
        $query = Pembayaran::with(['booking.user']);

        // Selalu tampilkan yang Menunggu Verifikasi
        $query->where('status_pembayaran', 'Menunggu Verifikasi')
              ->whereHas('booking', function ($q) {
                  $q->where('status_booking', '!=', 'Dibatalkan');
              });

        // Pencarian Teks (Nama atau ID Booking)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_booking', 'like', "%{$search}%")
                  ->orWhereHas('booking.user', function($qu) use ($search) {
                      $qu->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Tipe Pembayaran (Pertama/DP vs Pelunasan)
        if ($request->filled('tipe_pembayaran') && $request->input('tipe_pembayaran') !== 'Semua') {
            $tipe = $request->input('tipe_pembayaran');
            if ($tipe === 'Pelunasan') {
                $query->where('jenis_pembayaran', 'Pelunasan');
            } elseif ($tipe === 'Pertama') {
                $query->whereIn('jenis_pembayaran', ['DP', 'Lunas']);
            }
        }

        // 3. Tarik data pembayaran beserta info booking
        $pembayarans = $query->orderBy('created_at', 'desc')
                             ->paginate(5)
                             ->withQueryString(); // Mempertahankan parameter filter di URL pagination

        return view('admin-verifikasi', compact('pembayarans', 'pendingCount', 'approvedTodayCount', 'rejectedCount'));
    }

    /**
     * Memproses verifikasi (Validasi / Penolakan) dari Admin
     */
    public function verify(Request $request, $id_pembayaran)
    {
        $request->validate([
            'status_pembayaran' => ['required', 'in:Valid,Ditolak'],
            'catatan_admin'     => ['nullable', 'string'] 
        ]);

        DB::beginTransaction();

        try {
            // REVISI 4: Nama relasi diubah dari detailBookings menjadi detailBooking
            $pembayaran = Pembayaran::with('booking.detailBookings')->findOrFail($id_pembayaran);
            $booking = $pembayaran->booking;

            // 1. Update status di tabel `pembayaran`
            $pembayaran->update([
                'status_pembayaran' => $request->status_pembayaran,
                'catatan_admin'     => $request->catatan_admin
            ]);

            // 2. Logika pencabangan berdasarkan keputusan Admin
            if ($request->status_pembayaran === 'Valid') {
                
                // Tentukan status booking: Apakah ini DP atau Lunas?
                $newStatusBooking = ($pembayaran->sisa_tagihan > 0) ? 'Half Paid' : 'Confirmed';
                $booking->update(['status_booking' => $newStatusBooking]);

                // Karena sudah dibayar (DP/Lunas), kunci jadwal secara permanen menjadi 'Terbooking'
                foreach ($booking->detailBookings as $detail) {
                    Jadwal::where('id_jadwal', $detail->id_jadwal)
                          ->update(['status_jadwal' => 'Terbooking']);
                }

            } else {
                // Jika DITOLAK, kembalikan status booking agar pelanggan bisa bayar ulang
                // Jika dia ditolak saat pelunasan, maka kembalikan ke Half Paid
                $sudahDibayarValid = Pembayaran::where('id_booking', $booking->id_booking)->where('status_pembayaran', 'Valid')->sum('nominal_dibayar');
                
                $revertedStatus = ($sudahDibayarValid > 0) ? 'Half Paid' : 'Menunggu Pembayaran';
                $booking->update(['status_booking' => $revertedStatus]);
            }

            $tipeNotif = $request->status_pembayaran === 'Valid' ? 'Booking Dikonfirmasi' : 'Pembayaran Ditolak';
            $pesanNotif = $request->status_pembayaran === 'Valid' 
                ? "Admin telah memverifikasi pembayaran untuk pesanan #{$booking->id_booking}."
                : "Admin menolak bukti pembayaran untuk pesanan #{$booking->id_booking}.";

            AdminNotification::create([
                'tipe_notifikasi' => $tipeNotif,
                'pesan' => $pesanNotif,
                'id_booking' => $booking->id_booking,
                'is_urgent' => false
            ]);

            DB::commit();
            return back()->with('success', 'Status pembayaran berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->with('error', 'Gagal memverifikasi pembayaran.');
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';

    // PK berupa string (BKG-2105-001), bukan integer
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_booking',
        'id_user',
        'tipe_booking',
        'nama_tim',
        'status_booking',
        'total_tagihan',
    ];

    // Generate kode booking otomatis sebelum disimpan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->id_booking)) {
                $booking->id_booking = self::generateKode();
            }
        });
    }

    // Format: BKG-DDMM-XXX (contoh: BKG-2105-001)
    private static function generateKode(): string
    {
        $tanggal = now()->format('dm'); // 2105
        $terakhir = self::whereDate('created_at', today())->count() + 1;
        $urutan  = str_pad($terakhir, 3, '0', STR_PAD_LEFT); // 001, 002, dst

        return "BKG-{$tanggal}-{$urutan}";
    }

    // Booking ini milik siapa
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Booking ini terdiri dari jadwal-jadwal apa saja
    public function detailBookings()
    {
        return $this->hasMany(DetailBooking::class, 'id_booking', 'id_booking');
    }

    // Shortcut langsung ke jadwal (melewati detail_booking)
    public function jadwals()
    {
        return $this->belongsToMany(
            Jadwal::class,
            DetailBooking::class,
            'detail_booking',   // FK di detail_booking → booking
            'id_jadwal',    // FK di jadwal → detail_booking
            'id_booking',   // PK di booking
            )->withPivot('harga_final')->withTimestamps();
    }

    // Booking ini punya pembayaran apa saja
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_booking', 'id_booking');
    }

    // Ambil pembayaran terakhir
    public function pembayaranTerakhir()
    {
        return $this->hasOne(Pembayaran::class, 'id_booking', 'id_booking')
                    ->latestOfMany('waktu_pembayaran');
    }

    // Auto-update status Lunas menjadi Selesai jika jadwal sudah berlalu
    public static function updateStatusSelesai($userId = null)
    {
        $query = self::with('detailBookings.jadwal.harga')->whereIn('status_booking', ['Lunas', 'Confirmed']);
        
        if ($userId) {
            $query->where('id_user', $userId);
        }

        $bookings = $query->get();
        $now = \Carbon\Carbon::now();

        foreach ($bookings as $booking) {
            $waktuSelesaiTerakhir = null;
            foreach ($booking->detailBookings as $detail) {
                if ($detail->jadwal && $detail->jadwal->harga) {
                    $tanggalStr = $detail->jadwal->tanggal instanceof \Carbon\Carbon ? $detail->jadwal->tanggal->format('Y-m-d') : $detail->jadwal->tanggal;
                    $waktuSelesai = \Carbon\Carbon::parse($tanggalStr . ' ' . $detail->jadwal->harga->jam_selesai);
                    
                    if (!$waktuSelesaiTerakhir || $waktuSelesai->greaterThan($waktuSelesaiTerakhir)) {
                        $waktuSelesaiTerakhir = $waktuSelesai;
                    }
                }
            }

            if ($waktuSelesaiTerakhir && $now->greaterThan($waktuSelesaiTerakhir)) {
                $booking->update(['status_booking' => 'Selesai']);
            }
        }

        // 2. Auto-cancel pesanan yang masih 'Menunggu Pembayaran' tapi sudah lewat waktu main
        $queryUnpaid = self::with('detailBookings.jadwal.harga')
            ->where('status_booking', 'Menunggu Pembayaran');
        
        if ($userId) {
            $queryUnpaid->where('id_user', $userId);
        }

        $unpaidBookings = $queryUnpaid->get();
        foreach ($unpaidBookings as $booking) {
            if ($booking->isPastPlayTime()) {
                $booking->update(['status_booking' => 'Dibatalkan']);
                foreach ($booking->detailBookings as $detail) {
                    if ($detail->id_jadwal) {
                        \App\Models\Jadwal::where('id_jadwal', $detail->id_jadwal)
                            ->update(['status_jadwal' => 'Tersedia']);
                    }
                }
            }
        }
    }

    /**
     * Cek apakah pesanan sudah melewati jadwal bermain (waktu_selesai terakhir)
     */
    public function isPastPlayTime(): bool
    {
        $waktuSelesaiTerakhir = null;
        $now = \Carbon\Carbon::now();
        foreach ($this->detailBookings as $detail) {
            if ($detail->jadwal && $detail->jadwal->harga) {
                $tanggalStr = $detail->jadwal->tanggal instanceof \Carbon\Carbon ? $detail->jadwal->tanggal->format('Y-m-d') : $detail->jadwal->tanggal;
                $waktuSelesai = \Carbon\Carbon::parse($tanggalStr . ' ' . $detail->jadwal->harga->jam_selesai);
                
                if (!$waktuSelesaiTerakhir || $waktuSelesai->greaterThan($waktuSelesaiTerakhir)) {
                    $waktuSelesaiTerakhir = $waktuSelesai;
                }
            }
        }
        return $waktuSelesaiTerakhir && $now->greaterThan($waktuSelesaiTerakhir);
    }

    /**
     * Cek apakah sekarang sedang berada pada waktu bermain (antara jam mulai dan jam selesai)
     */
    public function isPlayingTime(): bool
    {
        $waktuMulaiAwal = null;
        $waktuSelesaiTerakhir = null;
        $now = \Carbon\Carbon::now();
        
        foreach ($this->detailBookings as $detail) {
            if ($detail->jadwal && $detail->jadwal->harga) {
                $tanggalStr = $detail->jadwal->tanggal instanceof \Carbon\Carbon ? $detail->jadwal->tanggal->format('Y-m-d') : $detail->jadwal->tanggal;
                $waktuMulai = \Carbon\Carbon::parse($tanggalStr . ' ' . $detail->jadwal->harga->jam_mulai);
                $waktuSelesai = \Carbon\Carbon::parse($tanggalStr . ' ' . $detail->jadwal->harga->jam_selesai);
                
                if (!$waktuMulaiAwal || $waktuMulai->lessThan($waktuMulaiAwal)) {
                    $waktuMulaiAwal = $waktuMulai;
                }
                
                if (!$waktuSelesaiTerakhir || $waktuSelesai->greaterThan($waktuSelesaiTerakhir)) {
                    $waktuSelesaiTerakhir = $waktuSelesai;
                }
            }
        }
        
        return $waktuMulaiAwal && $waktuSelesaiTerakhir && $now->between($waktuMulaiAwal, $waktuSelesaiTerakhir);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_booking',
        'jenis_pembayaran',
        'nominal_dibayar',
        'sisa_tagihan',
        'bukti_transfer',
        'waktu_pembayaran',
        'status_pembayaran',
        'catatan_admin',
    ];

    protected function casts(): array
    {
        return [
            'waktu_pembayaran' => 'datetime',
            'nominal_dibayar'  => 'decimal:2',
            'sisa_tagihan'     => 'decimal:2',
        ];
    }

    // Pembayaran ini untuk booking mana
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }
}
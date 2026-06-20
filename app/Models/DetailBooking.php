<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    protected $table = 'detail_booking';
    protected $primaryKey = 'id_detail_booking';

    protected $fillable = [
        'id_booking',
        'id_jadwal',
        'harga_final',
    ];

    // Detail ini milik booking mana
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }

    // Detail ini merujuk ke jadwal mana
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $table = 'harga';
    protected $primaryKey = 'id_harga';

    protected $fillable = [
        'blok_waktu',
        'harga',
        'jam_mulai',
        'jam_selesai',
        'is_active',
    ];

    // Satu blok harga bisa dipakai banyak jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_harga', 'id_harga');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalLapangan extends Model
{
    //
    use HasFactory;
    protected $table = 'jadwal_lapangans';
    protected $primaryKey = 'id';
    protected $fillable = ['*'];
}

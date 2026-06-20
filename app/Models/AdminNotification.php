<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';

    protected $fillable = [
        'tipe_notifikasi',
        'pesan',
        'id_booking',
        'is_read',
        'is_urgent',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'is_urgent' => 'boolean',
        ];
    }
}
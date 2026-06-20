<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE booking MODIFY COLUMN status_booking ENUM('Menunggu Pembayaran', 'Menunggu Verifikasi', 'Half Paid', 'Confirmed', 'Dibatalkan', 'Selesai') DEFAULT 'Menunggu Pembayaran'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE booking MODIFY COLUMN status_booking ENUM('Menunggu Pembayaran', 'Menunggu Verifikasi', 'Half Paid', 'Confirmed', 'Dibatalkan') DEFAULT 'Menunggu Pembayaran'");
    }
};

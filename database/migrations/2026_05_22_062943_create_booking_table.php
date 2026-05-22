<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            // PK manual berupa kode unik
            $table->string('id_booking', 20)->primary();
            $table->unsignedBigInteger('id_user');
            $table->enum('tipe_booking', ['Reguler', 'Member']);
            $table->enum('status_booking', [
                'Menunggu Pembayaran',
                'Menunggu Verifikasi',
                'Half Paid',      // sudah bayar DP, belum lunas
                'Confirmed',      // sudah lunas dan diverifikasi
                'Dibatalkan'
            ])->default('Menunggu Pembayaran');
            $table->decimal('total_tagihan', 10, 2);
            $table->timestamps(); // created_at penting untuk laporan & analitik

            // Foreign key ke tabel users
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
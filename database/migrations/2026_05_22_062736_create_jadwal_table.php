<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_harga');
            $table->enum('status_jadwal', [
                'Tersedia',
                'Pending',    // dikunci sementara saat proses booking
                'Terbooking', // sudah confirmed
                'Maintenance',
                'Tutup'
            ])->default('Tersedia');
            $table->timestamps();

            // Foreign key ke tabel harga
            $table->foreign('id_harga')
                  ->references('id_harga')
                  ->on('harga')
                  ->onDelete('restrict'); // harga tidak bisa dihapus kalau masih ada jadwal

            // Satu tanggal + satu blok harga hanya boleh ada sekali (mencegah duplikat jadwal)
            $table->unique(['tanggal', 'id_harga']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
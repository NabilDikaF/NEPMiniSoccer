<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_booking', function (Blueprint $table) {
            $table->id('id_detail_booking');
            $table->string('id_booking', 20);
            $table->unsignedBigInteger('id_jadwal');
            // harga_final dikunci saat booking dibuat,
            // supaya kalau admin ubah harga, histori tetap akurat
            $table->decimal('harga_final', 10, 2);
            $table->timestamps();

            // Foreign key ke tabel booking
            $table->foreign('id_booking')
                  ->references('id_booking')
                  ->on('booking')
                  ->onDelete('cascade'); // kalau booking dihapus, detail ikut terhapus

            // Foreign key ke tabel jadwal
            $table->foreign('id_jadwal')
                  ->references('id_jadwal')
                  ->on('jadwal')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_booking');
    }
};
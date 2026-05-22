<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->string('id_booking', 20);
            $table->enum('jenis_pembayaran', ['DP', 'Pelunasan', 'Lunas']);
            $table->decimal('nominal_dibayar', 10, 2);
            $table->decimal('sisa_tagihan', 10, 2)->default(0);
            // bukti_transfer menyimpan path file gambar yang diupload
            $table->string('bukti_transfer', 255)->nullable();
            $table->dateTime('waktu_pembayaran')->useCurrent();
            $table->enum('status_pembayaran', [
                'Menunggu Verifikasi',
                'Valid',
                'Ditolak'
            ])->default('Menunggu Verifikasi');
            // catatan_admin diisi saat admin menolak bukti pembayaran
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            // Foreign key ke tabel booking
            $table->foreign('id_booking')
                  ->references('id_booking')
                  ->on('booking')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
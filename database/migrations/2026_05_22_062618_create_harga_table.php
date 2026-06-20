<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('harga', function (Blueprint $table) {
            $table->id('id_harga');
            $table->string('blok_waktu', 50); // contoh: Pagi, Siang, Sore, Malam
            $table->decimal('harga', 10, 2);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harga');
    }
};
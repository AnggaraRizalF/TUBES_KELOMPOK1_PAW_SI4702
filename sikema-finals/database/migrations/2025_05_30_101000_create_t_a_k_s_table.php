<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User yang menginput TAK
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatans')->onDelete('set null'); // Kegiatan terkait (bisa null jika TAK dari kegiatan non-sistem)
            $table->string('nama_kegiatan_external')->nullable(); // Jika TAK dari kegiatan di luar sistem
            $table->string('penyelenggara_external')->nullable(); // Penyelenggara kegiatan di luar sistem
            $table->date('tanggal_kegiatan_external')->nullable(); // Tanggal kegiatan di luar sistem
            $table->integer('poin_didapat'); // Poin TAK yang diinput/didapat
            $table->string('bukti_sertifikat'); // Path file sertifikat/bukti
            $table->enum('status_verifikasi', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable(); // Catatan dari admin jika ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_a_k_s');
    }
};

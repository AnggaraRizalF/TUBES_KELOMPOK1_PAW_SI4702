<?php

// database/migrations/2025_05_30_112859_create_pendaftaran_kegiatans_table.php

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
        Schema::create('pendaftaran_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->enum('status_pendaftaran', ['pending', 'terdaftar', 'selesai', 'dibatalkan'])->default('pending'); 
            $table->string('bukti_pembayaran')->nullable();
            $table->text('catatan_admin')->nullable(); 
            $table->timestamps();

            
            $table->unique(['user_id', 'kegiatan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kegiatans');
    }
};

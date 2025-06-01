<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAK extends Model
{
    use HasFactory;

    protected $table = 'tak'; // Nama tabel kustom

    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'nama_kegiatan_external',
        'penyelenggara_external',
        'tanggal_kegiatan_external',
        'poin_didapat',
        'bukti_sertifikat',
        'status_verifikasi',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_kegiatan_external' => 'date',
        'status_verifikasi' => 'string',
    ];

    // Relasi: Banyak TAK dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Banyak TAK mungkin terkait dengan satu kegiatan (jika dari kegiatan sistem)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}

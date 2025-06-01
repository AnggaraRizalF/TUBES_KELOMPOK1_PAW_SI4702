<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama_kegiatan',
        'deskripsi',
        'tempat',
        'tanggal_mulai',
        'tanggal_selesai',
        'poin_tak',
        'poster_kegiatan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKegiatan::class, 'kategori_id');
    }

    public function pendaftaranKegiatans()
    {
        return $this->hasMany(PendaftaranKegiatan::class);
    }
}

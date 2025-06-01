<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_kegiatans';

    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'tanggal_daftar',
        'status', 
    ];

       public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    
    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class, 'pendaftaran_id'); 
    }
}

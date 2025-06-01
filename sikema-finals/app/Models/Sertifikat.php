<?php
// app/Models/Sertifikat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikats'; 

    protected $fillable = [
        'pendaftaran_id', 
        'file_path',
        'nama_file',
    ];
    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranKegiatan::class, 'pendaftaran_id');
    }

    // Jika sertifikat punya user_id dan kegiatan_id sendiri
    public function user() { return $this->belongsTo(User::class); }
    public function kegiatan() { return $this->belongsTo(Kegiatan::class); }
}

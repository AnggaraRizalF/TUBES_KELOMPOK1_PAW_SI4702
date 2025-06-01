<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Illuminate\Support\Facades\Auth;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Storage;

class PendaftaranKegiatanController extends Controller
{

    public function store(Request $request, Kegiatan $kegiatan)
    {
        $user = Auth::user();

        if ($kegiatan->tanggal_selesai->isPast()) {
            return redirect()->back()->with('error', 'Tidak bisa mendaftar kegiatan yang sudah selesai.');
        }

        $existingPendaftaran = PendaftaranKegiatan::where('user_id', $user->id)
                                                    ->where('kegiatan_id', $kegiatan->id)
                                                    ->first();

        if ($existingPendaftaran) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di kegiatan ini.');
        }

        PendaftaranKegiatan::create([
            'user_id' => $user->id,
            'kegiatan_id' => $kegiatan->id,
            'status_pendaftaran' => 'terdaftar', 
        ]);

        return redirect()->route('user.pendaftaran.index')
                        ->with('success', 'Berhasil mendaftar kegiatan ' . $kegiatan->nama_kegiatan . '.');
    }

   
    public function index()
    {
        $user = Auth::user();
        $pendaftarans = PendaftaranKegiatan::where('user_id', $user->id)
                                        ->with('kegiatan')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);

        return view('user.pendaftaran.index', compact('pendaftarans'));
    }

    public function riwayatKegiatan(Request $request)
    {
        $user = Auth::user();
        $query = PendaftaranKegiatan::where('user_id', $user->id)
                                    ->whereHas('kegiatan', function ($q) {
                                         $q->where('tanggal_selesai', '<', now()); 
                                    })
                                    ->with('kegiatan', 'sertifikat')
                                    ->orderBy('created_at', 'desc');

        $riwayatKegiatans = $query->paginate(10);

        return view('user.riwayat_kegiatan.index', compact('riwayatKegiatans'));
    }

    
    public function unduhSertifikat(Sertifikat $sertifikat)
    {
        
        if ($sertifikat->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke sertifikat ini.');
        }

        
        if (Storage::exists(str_replace('/storage/', 'public/', $sertifikat->file_path))) {
            return Storage::download(str_replace('/storage/', 'public/', $sertifikat->file_path));
        }

        return redirect()->back()->with('error', 'File sertifikat tidak ditemukan.');
    }
}

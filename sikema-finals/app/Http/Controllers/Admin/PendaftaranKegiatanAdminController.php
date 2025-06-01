<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendaftaranKegiatan; 

class PendaftaranKegiatanAdminController extends Controller
{
    
    public function index()
    {
       
        $pendaftarans = PendaftaranKegiatan::with(['user', 'kegiatan'])
                                            ->where('status_pendaftaran', 'pending') 
                                            ->orderBy('created_at', 'asc')
                                            ->paginate(10);

        return view('admin.pendaftaran_kegiatan.index', compact('pendaftarans'));
    }

    
    public function approve(Request $request, PendaftaranKegiatan $pendaftaran)
    {
        $pendaftaran->status_pendaftaran = 'terdaftar';
        $pendaftaran->catatan_admin = $request->catatan_admin; 
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Pendaftaran berhasil disetujui.');
    }

    public function reject(Request $request, PendaftaranKegiatan $pendaftaran)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:500', 
        ], [
            'catatan_admin.required' => 'Catatan penolakan wajib diisi.',
        ]);

        $pendaftaran->status_pendaftaran = 'dibatalkan';
        $pendaftaran->catatan_admin = $request->catatan_admin;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Pendaftaran berhasil ditolak.');
    }

    public function show(PendaftaranKegiatan $pendaftaran)
    {
        return view('admin.pendaftaran_kegiatan.show', compact('pendaftaran'));
    }
}

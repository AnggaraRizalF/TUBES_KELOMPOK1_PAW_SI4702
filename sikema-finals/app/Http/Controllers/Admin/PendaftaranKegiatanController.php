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
    
    public function show(PendaftaranKegiatan $pendaftaran)
    {
        return view('admin.pendaftaran_kegiatan.show', compact('pendaftaran'));
    }
}

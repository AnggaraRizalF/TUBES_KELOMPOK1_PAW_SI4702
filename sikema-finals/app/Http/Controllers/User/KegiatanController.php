<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Carbon; 
class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::with('kategori')
                        ->where('tanggal_selesai', '>=', Carbon::now()->startOfDay());

        if ($request->has('bulan')) {
            $bulan = (int) $request->bulan;
            $tahun = (int) ($request->tahun ?? Carbon::now()->year);
            $query->whereMonth('tanggal_mulai', $bulan)
                ->whereYear('tanggal_mulai', $tahun);
        }

        $kegiatans = $query->orderBy('tanggal_mulai', 'asc')->paginate(10);

        return view('user.kegiatan.index', compact('kegiatans'));
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('kategori');
        $isRegistered = auth()->user()
                            ->pendaftaranKegiatans()
                            ->where('kegiatan_id', $kegiatan->id)
                            ->exists();

        return view('user.kegiatan.show', compact('kegiatan', 'isRegistered'));
    }
}

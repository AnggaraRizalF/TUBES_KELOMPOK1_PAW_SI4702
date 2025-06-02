<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendaftaranKegiatan;
use App\Models\TAK;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalTAKVerified = TAK::where('user_id', $user->id)
                                ->where('status_verifikasi', 'diverifikasi')
                                ->sum('poin_didapat');

        $totalKegiatanDidaftar = PendaftaranKegiatan::where('user_id', $user->id)
                                                    ->whereIn('status_pendaftaran', ['terdaftar', 'selesai'])
                                                    ->count();

        $latestPendaftaran = PendaftaranKegiatan::where('user_id', $user->id)
                                                ->with('kegiatan')
                                                ->latest()
                                                ->first();

        $pendingTAKCount = TAK::where('user_id', $user->id)
                                ->where('status_verifikasi', 'pending')
                                ->count();

        return view('user.dashboard', compact('totalTAKVerified', 'totalKegiatanDidaftar', 'latestPendaftaran', 'pendingTAKCount'));
    }
}

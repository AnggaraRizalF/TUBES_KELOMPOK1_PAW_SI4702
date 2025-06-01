<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use App\Models\TAK;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalKegiatans = Kegiatan::count();
        $totalPendaftar = PendaftaranKegiatan::count();
        $pendingTAK = TAK::where('status_verifikasi', 'pending')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalKegiatans', 'totalPendaftar', 'pendingTAK'));
    }
}


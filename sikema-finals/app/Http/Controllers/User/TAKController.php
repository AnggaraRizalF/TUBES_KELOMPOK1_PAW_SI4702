<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TAK;
use App\Models\Kegiatan; // Import model Kegiatan jika ingin memilih kegiatan internal
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TAKController extends Controller
{
    /**
     * Display a listing of the resource (riwayat TAK user).
     */
    public function riwayat()
    {
        $user = Auth::user();
        $taks = TAK::where('user_id', $user->id)
                    ->with('kegiatan') // Eager load kegiatan jika ada
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('user.tak.riwayat', compact('taks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Opsional: kirim daftar kegiatan yang sudah selesai ke view jika TAK bisa dipilih dari kegiatan sistem
        // $completedKegiatans = Kegiatan::where('tanggal_selesai', '<', now())->get();
        // return view('user.tak.create', compact('completedKegiatans'));
        return view('user.tak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Jika memilih dari kegiatan internal
            'kegiatan_id' => 'nullable|exists:kegiatans,id',
            // Jika kegiatan eksternal
            'nama_kegiatan_external' => 'required_without:kegiatan_id|string|max:255',
            'penyelenggara_external' => 'required_without:kegiatan_id|string|max:255',
            'tanggal_kegiatan_external' => 'required_without:kegiatan_id|date',
            'poin_didapat' => 'required|integer|min:1',
            'bukti_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB
        ]);

        $data = $request->except('bukti_sertifikat');
        $data['user_id'] = Auth::id();
        $data['status_verifikasi'] = 'pending'; // Default saat diinput user

        if ($request->hasFile('bukti_sertifikat')) {
            $path = $request->file('bukti_sertifikat')->store('public/tak_bukti');
            $data['bukti_sertifikat'] = Storage::url($path);
        } else {
            return redirect()->back()->with('error', 'Bukti sertifikat wajib diunggah.');
        }

        // Jika kegiatan internal dipilih, ambil poin TAK dari kegiatan tersebut
        if ($request->kegiatan_id) {
            $kegiatan = Kegiatan::find($request->kegiatan_id);
            if ($kegiatan) {
                $data['poin_didapat'] = $kegiatan->poin_tak; // Otomatis mengisi poin TAK dari kegiatan sistem
                $data['nama_kegiatan_external'] = null; // Kosongkan jika dari internal
                $data['penyelenggara_external'] = null;
                $data['tanggal_kegiatan_external'] = null;
            }
        }

        TAK::create($data);

        return redirect()->route('user.tak.riwayat')
                        ->with('success', 'TAK berhasil diinput dan menunggu verifikasi admin.');
    }

    // Metode show, edit, update, destroy untuk TAK akan dikelola oleh admin
    // User hanya bisa melihat riwayat, bukan edit/hapus TAK yang sudah diinput
    // Untuk CRUD Admin TAK, akan dibahas di bagian verifikasi
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TAK;
use Illuminate\Support\Facades\Storage;

class TAKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusFilter = $request->input('status', 'pending'); // Default: pending
        $searchQuery = $request->input('search');

        $taks = TAK::with('user', 'kegiatan')
                    ->when($statusFilter && $statusFilter !== 'all', function ($query) use ($statusFilter) {
                        return $query->where('status_verifikasi', $statusFilter);
                    })
                    ->when($searchQuery, function ($query) use ($searchQuery) {
                        return $query->where(function($q) use ($searchQuery) {
                            $q->where('nama_kegiatan_external', 'like', '%' . $searchQuery . '%')
                                ->orWhereHas('user', function($q2) use ($searchQuery) {
                            $q2->where('name', 'like', '%' . $searchQuery . '%')
                                ->orWhere('email', 'like', '%' . $searchQuery . '%');
                            })
                            ->orWhereHas('kegiatan', function($q2) use ($searchQuery) {
                            $q2->where('nama_kegiatan', 'like', '%' . $searchQuery . '%');
                            });
                        });
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('admin.tak.index', compact('taks', 'statusFilter', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TAK $tak)
    {
        $tak->load('user', 'kegiatan'); // Load relasi user dan kegiatan
        return view('admin.tak.show', compact('tak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TAK $tak)
    {
        $tak->load('user', 'kegiatan');
        return view('admin.tak.edit', compact('tak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TAK $tak)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:pending,diverifikasi,ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $tak->update($request->only('status_verifikasi', 'catatan_admin'));

        return redirect()->route('admin.tak.index')
                        ->with('success', 'Status TAK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TAK $tak)
    {
        // Hapus file bukti sertifikat dari storage
        if ($tak->bukti_sertifikat) {
            Storage::delete(str_replace('/storage/', 'public/', $tak->bukti_sertifikat));
        }
        $tak->delete();

        return redirect()->route('admin.tak.index')
                        ->with('success', 'TAK berhasil dihapus.');
    }
}

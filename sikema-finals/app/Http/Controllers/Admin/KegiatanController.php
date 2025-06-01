<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\KategoriKegiatan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('kategori')->orderBy('tanggal_mulai', 'desc')->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        $kategoris = KategoriKegiatan::all();
        return view('admin.kegiatan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_kegiatans,id',
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tempat' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'poin_tak' => 'required|integer|min:0',
            'poster_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
        ]);

        $data = $request->except('poster_kegiatan');

        if ($request->hasFile('poster_kegiatan')) {
            $path = $request->file('poster_kegiatan')->store('public/posters');
            $data['poster_kegiatan'] = Storage::url($path);
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')
        ->with('success', 'Kegiatan berhasil ditambahkan.');

    }

    public function show(Kegiatan $kegiatan)
    {
        // load kategori
        $kegiatan->load('kategori');
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kategoris = KategoriKegiatan::all();
        return view('admin.kegiatan.edit', compact('kegiatan', 'kategoris'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_kegiatans,id',
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tempat' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'poin_tak' => 'required|integer|min:0',
            'poster_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->except('poster_kegiatan');

        if ($request->hasFile('poster_kegiatan')) {
            if ($kegiatan->poster_kegiatan) {
                Storage::delete(str_replace('/storage/', 'public/', $kegiatan->poster_kegiatan));
            }
            $path = $request->file('poster_kegiatan')->store('public/posters');
            $data['poster_kegiatan'] = Storage::url($path);
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
        ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->poster_kegiatan) {
            Storage::delete(str_replace('/storage/', 'public/', $kegiatan->poster_kegiatan));
        }
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
        ->with('success', 'Kegiatan berhasil dihapus.');
    }
}

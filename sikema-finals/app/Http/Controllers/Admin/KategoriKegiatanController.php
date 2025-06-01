<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatan;
use Illuminate\Http\Request;

class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriKegiatans = KategoriKegiatan::orderBy('nama_kategori')->paginate(10);
        return view('admin.kategori_kegiatan.index', compact('kategoriKegiatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori_kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_kegiatans',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriKegiatan::create($request->all());

        return redirect()->route('admin.kategori-kegiatan.index')
        ->with('success', 'Kategori kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKegiatan $kategoriKegiatan)
    {
        return view('admin.kategori_kegiatan.show', compact('kategoriKegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriKegiatan $kategoriKegiatan)
    {
        return view('admin.kategori_kegiatan.edit', compact('kategoriKegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriKegiatan $kategoriKegiatan)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_kegiatans,nama_kategori,' . $kategoriKegiatan->id,
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriKegiatan->update($request->all());

        return redirect()->route('admin.kategori-kegiatan.index')
        ->with('success', 'Kategori kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriKegiatan $kategoriKegiatan)
    {
        $kategoriKegiatan->delete();

        return redirect()->route('admin.kategori-kegiatan.index')
        ->with('success', 'Kategori kegiatan berhasil dihapus.');
    }
}

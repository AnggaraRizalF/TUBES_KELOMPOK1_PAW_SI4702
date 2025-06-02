<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Penting: Import Auth facade
use Illuminate\Support\Facades\Storage; // Penting: Jika digunakan di controller yang diakses dari sini
use App\Models\Sertifikat; // Penting: Jika digunakan di controller yang diakses dari sini

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // Alias untuk Dashboard Admin
use App\Http\Controllers\Admin\KategoriKegiatanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\TAKController as AdminTAKController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PendaftaranKegiatanAdminController;

// User Controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController; // Alias untuk Dashboard User
use App\Http\Controllers\User\KegiatanController as UserKegiatanController; // Untuk user melihat kegiatan
use App\Http\Controllers\User\PendaftaranKegiatanController;
use App\Http\Controllers\User\TAKController as UserTAKController;;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about'); // Mengarahkan ke file resources/views/about.blade.php
});

// Dashboard Umum (akan diarahkan berdasarkan role setelah login)
Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user(); // Ambil objek user yang sedang login

        if ($user->isAdmin()) { // Error Anda sebelumnya ada di sini
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Kategori Kegiatan
    Route::resource('kategori-kegiatan', KategoriKegiatanController::class);

    // CRUD Manajemen Kegiatan
    Route::resource('kegiatan', KegiatanController::class);

    // Manajemen dan Verifikasi TAK
    Route::resource('tak', AdminTAKController::class)->except(['create', 'store']); // Admin tidak membuat TAK baru, hanya mengelola
    // Pastikan alias AdminTAKController sudah diimport:

    // Manajemen Pengguna
    Route::resource('users', UserController::class); // Tambahkan ini

    // Rute untuk Verifikasi Pendaftaran Kegiatan
    Route::get('/pendaftaran-kegiatan', [PendaftaranKegiatanAdminController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran/{pendaftaran}/approve', [PendaftaranKegiatanAdminController::class, 'approve'])->name('pendaftaran.approve');
    Route::post('/pendaftaran/{pendaftaran}/reject', [PendaftaranKegiatanAdminController::class, 'reject'])->name('pendaftaran.reject');
    // Jika Anda ingin melihat detail pendaftaran
    Route::get('/pendaftaran/{pendaftaran}', [PendaftaranKegiatanAdminController::class, 'show'])->name('pendaftaran.show');
});

// Rute untuk User
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Kategori kegiatan (user bisa cek kegiatan yang ada di bulan ini)
    Route::get('/kegiatan', [UserKegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/{kegiatan}', [UserKegiatanController::class, 'show'])->name('kegiatan.show');

    // Pendaftaran Kegiatan
    Route::post('/kegiatan/{kegiatan}/daftar', [PendaftaranKegiatanController::class, 'store'])->name('kegiatan.daftar');
    Route::get('/pendaftaran', [PendaftaranKegiatanController::class, 'index'])->name('pendaftaran.index'); // Histori pendaftaran

    // Mahasiswa dapat menginput TAK
    Route::resource('tak', UserTAKController::class)->except(['edit', 'update']); // Admin yang update status
    Route::get('/riwayat-tak', [UserTAKController::class, 'riwayat'])->name('tak.riwayat'); // Histori TAK

    // Histori atau riwayat kegiatan yang dapat mengunduh sertifikat
    Route::get('/riwayat-kegiatan', [PendaftaranKegiatanController::class, 'riwayatKegiatan'])->name('riwayat-kegiatan.index');
    Route::get('/sertifikat/{sertifikat}/unduh', [PendaftaranKegiatanController::class, 'unduhSertifikat'])->name('sertifikat.unduh'); // Asumsi sertifikat terkait pendaftaran
});


// Rute standar Laravel Breeze (JANGAN DIHAPUS)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

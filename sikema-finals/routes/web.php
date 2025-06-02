<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Sertifikat;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriKegiatanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\TAKController as AdminTAKController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PendaftaranKegiatanAdminController;

// User Controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\KegiatanController as UserKegiatanController;
use App\Http\Controllers\User\PendaftaranKegiatanController;
use App\Http\Controllers\User\TAKController as UserTAKController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->isAdmin()) {
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
    Route::resource('tak', AdminTAKController::class)->except(['create', 'store']);

    // Manajemen Pengguna
    Route::resource('users', UserController::class);

    // Pendaftaran Kegiatan Admin (Verifikasi Pendaftaran)
    Route::get('/pendaftaran-kegiatan', [PendaftaranKegiatanAdminController::class, 'index'])->name('pendaftaran-kegiatan.index');
    Route::post('/pendaftaran-kegiatan/{pendaftaranKegiatan}/verify', [PendaftaranKegiatanAdminController::class, 'verify'])->name('pendaftaran-kegiatan.verify');
    Route::post('/pendaftaran-kegiatan/{pendaftaranKegiatan}/reject', [PendaftaranKegiatanAdminController::class, 'reject'])->name('pendaftaran-kegiatan.reject');
    Route::get('/pendaftaran-kegiatan/{pendaftaranKegiatan}', [PendaftaranKegiatanAdminController::class, 'show'])->name('pendaftaran-kegiatan.show');

});

// Rute untuk User
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/kegiatan', [UserKegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/{kegiatan}', [UserKegiatanController::class, 'show'])->name('kegiatan.show');

    Route::post('/kegiatan/{kegiatan}/daftar', [PendaftaranKegiatanController::class, 'store'])->name('kegiatan.daftar');
    Route::get('/pendaftaran', [PendaftaranKegiatanController::class, 'index'])->name('pendaftaran.index');

    Route::resource('tak', UserTAKController::class)->except(['edit', 'update']);
    Route::get('/riwayat-tak', [UserTAKController::class, 'riwayat'])->name('tak.riwayat');

    Route::get('/riwayat-kegiatan', [PendaftaranKegiatanController::class, 'riwayatKegiatan'])->name('riwayat-kegiatan.index');
    Route::get('/sertifikat/{sertifikat}/unduh', [PendaftaranKegiatanController::class, 'unduhSertifikat'])->name('sertifikat.unduh');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Sertifikat;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriKegiatanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\TAKController as AdminTAKController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PendaftaranKegiatanAdminController;

// User
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\KegiatanController as UserKegiatanController;
use App\Http\Controllers\User\PendaftaranKegiatanController;
use App\Http\Controllers\User\TAKController as UserTAKController;;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
});

// Dashboard
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

    Route::resource('kategori-kegiatan', KategoriKegiatanController::class);

    Route::resource('kegiatan', KegiatanController::class);

    Route::resource('tak', AdminTAKController::class)->except(['create', 'store']);

    Route::resource('users', UserController::class);

    Route::get('/pendaftaran-kegiatan', [PendaftaranKegiatanAdminController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran/{pendaftaran}/approve', [PendaftaranKegiatanAdminController::class, 'approve'])->name('pendaftaran.approve');
    Route::post('/pendaftaran/{pendaftaran}/reject', [PendaftaranKegiatanAdminController::class, 'reject'])->name('pendaftaran.reject');
    Route::get('/pendaftaran/{pendaftaran}', [PendaftaranKegiatanAdminController::class, 'show'])->name('pendaftaran.show');
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

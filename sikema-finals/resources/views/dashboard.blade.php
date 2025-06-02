@extends('layouts.app')

@section('header')
    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
        {{ __('User Dashboard') }}
    </h2>
@endsection

@section('content')

    <style>
        .telkom-red { background-color: #E30613; }
        .telkom-red-text { color: #E30613; }
        .text-dark-gray { color: #333333; }
        .text-medium-gray { color: #6B7280; }

        body { font-family: 'Poppins', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }

        .max-w-7xl.mx-auto > div.bg-white.shadow-lg.rounded-xl.p-6 {
            border-radius: 16px !important;
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.1) !important;
            padding: 2.5rem !important;
        }

        .dashboard-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 1.75rem;
            border-bottom-width: 5px;
            transition: all 0.3s ease-in-out;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .dashboard-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .quick-access-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            color: #2563EB;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }
        .quick-access-link:hover {
            color: #1E40AF;
            transform: translateX(5px);
        }
        .quick-access-link svg {
            color: #3B82F6;
            margin-right: 0.75rem;
            transition: color 0.2s ease-in-out;
        }
        .quick-access-link:hover svg {
            color: #1E40AF;
        }
        .quick-access-section-title {
            border-bottom: 2px solid #E5E7EB;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .card-verified { border-color: #10B981; }
        .card-registered { border-color: #3B82F6; }
        .card-pending { border-color: #F59E0B; }
        .card-latest { border-color: #8B5CF6; }

        .text-green-main { color: #10B981; }
        .text-blue-main { color: #3B82F6; }
        .text-yellow-main { color: #F59E0B; }
        .text-purple-main { color: #8B5CF6; }
    </style>

    {{-- KONTEN UTAMA DASHBOARD --}}

    <p class="text-xl font-medium text-medium-gray mb-8">Selamat datang, <span class="telkom-red-text font-bold">{{ Auth::user()->name }}!</span></p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 mb-10">

        {{--Total Poin TAK --}}
        <div class="dashboard-card card-verified">
            <div>
                <h3 class="text-base font-semibold text-gray-600 mb-2">Total Poin TAK (Terverifikasi)</h3>
                <p class="text-6xl font-bold text-green-main font-inter leading-tight">{{ $totalTAKVerified }}</p>
            </div>
            <p class="text-sm text-gray-500 mt-2">Pembaruan terakhir: Hari ini</p>
        </div>

        {{-- Kegiatan Didaftar --}}
        <div class="dashboard-card card-registered">
            <div>
                <h3 class="text-base font-semibold text-gray-600 mb-2">Kegiatan Didaftar</h3>
                <p class="text-6xl font-bold text-blue-main font-inter leading-tight">{{ $totalKegiatanDidaftar }}</p>
            </div>
            <p class="text-sm text-gray-500 mt-2">Anda memiliki {{ $totalKegiatanDidaftar }} kegiatan terdaftar</p>
        </div>

        {{-- TAK Menunggu Verifikasi --}}
        <div class="dashboard-card card-pending">
            <div>
                <h3 class="text-base font-semibold text-gray-600 mb-2">TAK Menunggu Verifikasi</h3>
                <p class="text-6xl font-bold text-yellow-main font-inter leading-tight">{{ $pendingTAKCount }}</p>
            </div>
            <p class="text-sm text-gray-500 mt-2">Segera periksa status verifikasi Anda</p>
        </div>

        {{-- Kegiatan Terbaru Didaftar --}}
        <div class="dashboard-card card-latest">
            <div>
                <h3 class="text-base font-semibold text-gray-600 mb-2">Kegiatan Terbaru Didaftar</h3>
                <p class="text-3xl font-bold text-purple-main font-inter leading-normal">
                    @if ($latestPendaftaran)
                        {{ $latestPendaftaran->kegiatan->nama_kegiatan }}
                    @else
                        Belum ada
                    @endif
                </p>
            </div>
            <p class="text-sm text-gray-500 mt-2">
                @if ($latestPendaftaran)
                    Pada tanggal {{ \Carbon\Carbon::parse($latestPendaftaran->tanggal_daftar)->format('d F Y') }}
                @else
                    Tidak ada kegiatan terbaru
                @endif
            </p>
        </div>

    </div>

    {{-- AKSES CEPAT --}}
    <div class="mt-8">
        <h3 class="text-2xl font-semibold text-dark-gray quick-access-section-title">Akses Cepat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-5 gap-x-8">
            <a href="{{ route('user.kegiatan.index') }}" class="quick-access-link">
                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A1 1 0 009.172 3H4a2 2 0 00-2 2zm7 5a1 1 0 10-2 0v4a1 1 0 102 0v-4z" clip-rule="evenodd"></path></svg>
                Cari & Daftar Kegiatan
            </a>
            <a href="{{ route('user.pendaftaran.index') }}" class="quick-access-link">
                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6H8a1 1 0 110-2h1V3a1 1 0 011-1zm-6 8a2 2 0 100 4h12a2 2 0 100-4H4zm4 5a1 1 0 11-2 0 1 1 0 012 0zm7-1a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                Riwayat Pendaftaran Kegiatan
            </a>
            <a href="{{ route('user.tak.create') }}" class="quick-access-link">
                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L14.414 5A2 2 0 0115 6.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h.01M6 10h.01M6 14h.01M10 4.5V9h4.5L10 4.5z" clip-rule="evenodd"></path></svg>
                Input TAK
            </a>
            <a href="{{ route('user.tak.riwayat') }}" class="quick-access-link">
                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                Riwayat TAK & Verifikasi
            </a>
            <a href="{{ route('user.riwayat-kegiatan.index') }}" class="quick-access-link">
                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
                Riwayat Kegiatan & Sertifikat
            </a>
        </div>
    </div>

@endsection

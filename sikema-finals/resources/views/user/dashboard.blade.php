<x-app-layout>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 bg-gray-800 rounded-lg shadow-lg text-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('User Dashboard') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                <p class="text-xl font-medium text-gray-200 mb-8">Selamat datang, <span class="font-bold text-red-500">{{ Auth::user()->name }}!</span></p> {{-- Nama user menggunakan Telkom Red --}}

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 mb-10">

                    {{--  1: Total Poin TAK --}}
                    <div class="bg-slate-900 shadow-lg rounded-xl p-6 border-b-4 border-emerald-500 flex flex-col justify-between hover:shadow-2xl transform hover:-translate-y-1 transition duration-300"> {{-- UBAH: bg-gray-900 jadi bg-slate-900 --}}
                        <div>
                            <h3 class="text-base font-semibold text-gray-300 mb-2">Total Poin TAK (Terverifikasi)</h3>
                            <p class="text-5xl font-extrabold text-emerald-300 font-inter leading-tight">{{ $totalTAKVerified ?? '0' }}</p> {{-- UBAH: text-emerald-400 jadi text-emerald-300 (sedikit lebih redup) --}}
                        </div>
                        <p class="text-xs text-gray-500 mt-4">Pembaruan terakhir: Hari ini</p>
                    </div>

                    {{-- 2: Kegiatan Didaftar --}}
                    <div class="bg-slate-900 shadow-lg rounded-xl p-6 border-b-4 border-blue-500 flex flex-col justify-between hover:shadow-2xl transform hover:-translate-y-1 transition duration-300"> {{-- UBAH: bg-gray-900 jadi bg-slate-900 --}}
                        <div>
                            <h3 class="text-base font-semibold text-gray-300 mb-2">Kegiatan Didaftar</h3>
                            <p class="text-5xl font-extrabold text-blue-300 font-inter leading-tight">{{ $totalKegiatanDidaftar ?? '0' }}</p> {{-- UBAH: text-blue-400 jadi text-blue-300 --}}
                        </div>
                        <p class="text-xs text-gray-500 mt-4">Anda memiliki {{ $totalKegiatanDidaftar ?? '0' }} kegiatan terdaftar</p>
                    </div>

                    {{-- 3: TAK Menunggu Verifikasi --}}
                    <div class="bg-slate-900 shadow-lg rounded-xl p-6 border-b-4 border-amber-500 flex flex-col justify-between hover:shadow-2xl transform hover:-translate-y-1 transition duration-300"> {{-- UBAH: bg-gray-900 jadi bg-slate-900 --}}
                        <div>
                            <h3 class="text-base font-semibold text-gray-300 mb-2">TAK Menunggu Verifikasi</h3>
                            <p class="text-5xl font-extrabold text-amber-300 font-inter leading-tight">{{ $pendingTAKCount ?? '0' }}</p> {{-- UBAH: text-amber-400 jadi text-amber-300 --}}
                        </div>
                        <p class="text-xs text-gray-500 mt-4">Segera periksa status verifikasi Anda</p>
                    </div>

                    {{-- 4: Kegiatan Terbaru Didaftar --}}
                    <div class="bg-slate-900 shadow-lg rounded-xl p-6 border-b-4 border-indigo-500 flex flex-col justify-between hover:shadow-2xl transform hover:-translate-y-1 transition duration-300"> {{-- UBAH: bg-gray-900 jadi bg-slate-900 --}}
                        <div>
                            <h3 class="text-base font-semibold text-gray-300 mb-2">Kegiatan Terbaru Daki</h3>
                            <p class="text-2xl font-extrabold text-indigo-300 font-inter leading-normal mb-1"> {{-- UBAH: text-indigo-400 jadi text-indigo-300 --}}
                                @if ($latestPendaftaran ?? null)
                                    {{ Str::limit($latestPendaftaran->kegiatan->nama_kegiatan, 40) }}
                                @else
                                    Belum ada
                                @endif
                            </p>
                        </div>
                        <p class="text-xs text-gray-500 mt-4">
                            @if ($latestPendaftaran ?? null)
                                Pada tanggal {{ \Carbon\Carbon::parse($latestPendaftaran->tanggal_daftar)->format('d F Y') }}
                            @else
                                Tidak ada kegiatan terbaru
                            @endif
                        </p>
                    </div>

                </div>
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold text-gray-200 border-b-2 border-gray-700 pb-4 mb-6">Akses Cepat</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        <a href="{{ route('user.kegiatan.index') }}" class="flex items-center p-4 bg-gray-700 rounded-lg shadow-md text-gray-200 font-medium hover:bg-gray-600 hover:text-white transform hover:-translate-y-1 transition duration-200">
                            <svg class="w-6 h-6 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A1 1 0 009.172 3H4a2 2 0 00-2 2zm7 5a1 1 0 10-2 0v4a1 1 0 102 0v-4z" clip-rule="evenodd"></path></svg>
                            <span>Cari & Daftar Kegiatan</span>
                        </a>
                        <a href="{{ route('user.pendaftaran.index') }}" class="flex items-center p-4 bg-gray-700 rounded-lg shadow-md text-gray-200 font-medium hover:bg-gray-600 hover:text-white transform hover:-translate-y-1 transition duration-200">
                            <svg class="w-6 h-6 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6H8a1 1 0 110-2h1V3a1 1 0 011-1zm-6 8a2 2 0 100 4h12a2 2 0 100-4H4zm4 5a1 1 0 11-2 0 1 1 0 012 0zm7-1a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                            <span>Riwayat Pendaftaran Kegiatan</span>
                        </a>
                        <a href="{{ route('user.tak.create') }}" class="flex items-center p-4 bg-gray-700 rounded-lg shadow-md text-gray-200 font-medium hover:bg-gray-600 hover:text-white transform hover:-translate-y-1 transition duration-200">
                            <svg class="w-6 h-6 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L14.414 5A2 2 0 0115 6.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h.01M6 10h.01M6 14h.01M10 4.5V9h4.5L10 4.5z" clip-rule="evenodd"></path></svg>
                            <span>Input TAK</span>
                        </a>
                        <a href="{{ route('user.tak.riwayat') }}" class="flex items-center p-4 bg-gray-700 rounded-lg shadow-md text-gray-200 font-medium hover:bg-gray-600 hover:text-white transform hover:-translate-y-1 transition duration-200">
                            <svg class="w-6 h-6 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                            <span>Riwayat TAK & Verifikasi</span>
                        </a>
                        <a href="{{ route('user.riwayat-kegiatan.index') }}" class="flex items-center p-4 bg-gray-700 rounded-lg shadow-md text-gray-200 font-medium hover:bg-gray-600 hover:text-white transform hover:-translate-y-1 transition duration-200">
                            <svg class="w-6 h-6 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
                            <span>Riwayat Kegiatan & Sertifikat</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-gray-700 p-4 rounded-lg">
            {{ __('Detail Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <div class="md:flex md:space-x-8">
                        <div class="md:w-1/3">

                            {{-- Kotak poster kegiatan --}}
                            @if ($kegiatan->poster_kegiatan)
                                <img src="{{ asset('storage/' . $kegiatan->poster_kegiatan) }}" alt="Poster Kegiatan" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-700 flex items-center justify-center text-gray-300 rounded-lg shadow-md">
                                    {{ __('Tidak ada poster tersedia') }}
                                </div>
                            @endif
                        </div>
                        <div class="md:w-2/3 mt-6 md:mt-0">
                            <h3 class="text-3xl font-bold text-white mb-4">{{ $kegiatan->nama_kegiatan }}</h3>

                            <div class="mb-4 text-white">
                                <p class="text-md mb-2"><span class="font-semibold text-gray-300">Kategori:</span> {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}</p>
                                <p class="text-md mb-2"><span class="font-semibold text-gray-300">Deskripsi:</span> {{ $kegiatan->deskripsi }}</p>
                                <p class="text-md mb-2"><span class="font-semibold text-gray-300">Tempat:</span> {{ $kegiatan->tempat }}</p>
                                <p class="text-md mb-2"><span class="font-semibold text-gray-300">Tanggal Mulai:</span> {{ $kegiatan->tanggal_mulai->format('d M Y, H:i') }}</p>
                                <p class="text-md mb-2"><span class="font-semibold text-gray-300">Tanggal Selesai:</span> {{ $kegiatan->tanggal_selesai->format('d M Y, H:i') }}</p>
                                <p class="text-lg font-bold text-blue-400 mt-4">Poin TAK: {{ $kegiatan->poin_tak }}</p>
                            </div>

                            <div class="mt-6">
                                @if ($kegiatan->tanggal_selesai->isPast())
                                    <p class="text-red-400 font-semibold text-lg">Kegiatan ini telah selesai.</p>
                                @elseif ($isRegistered)
                                    <p class="text-green-400 font-semibold text-lg">Anda sudah terdaftar di kegiatan ini!</p>
                                @else
                                    <form action="{{ route('user.kegiatan.daftar', $kegiatan->id) }}" method="POST">
                                        @csrf

                                        <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white">
                                            {{ __('Daftar Kegiatan Ini') }}
                                        </x-primary-button>
                                    </form>
                                @endif
                                <a href="{{ route('user.kegiatan.index') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150
                                    bg-gray-600 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    {{ __('Kembali ke Daftar Kegiatan') }}
                                </a>
                            </div>

                            @if (session('success'))
                                <div class="bg-green-700 border border-green-600 text-white px-4 py-3 rounded relative mt-4" role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="bg-red-700 border border-red-600 text-white px-4 py-3 rounded relative mt-4" role="alert">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

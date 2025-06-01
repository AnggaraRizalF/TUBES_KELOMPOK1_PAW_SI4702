<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-gray-700 p-4 rounded-lg">
            {{ __('Daftar Kegiatan Kampus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-6 text-center text-gray-200">
                        {{ __('Kegiatan Mendatang / Sedang Berlangsung') }}
                    </h3>

                    {{-- Daftar Kegiatan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden p-4">
                                @if ($kegiatan->poster_kegiatan)
                                    <img src="{{ asset('storage/' . $kegiatan->poster_kegiatan) }}" alt="Poster Kegiatan" class="w-full h-48 object-contain rounded-md mb-4">
                                @else
                                    <div class="w-full h-48 bg-gray-600 flex items-center justify-center rounded-md mb-4">
                                        <span class="text-gray-300">{{ __('Tidak ada poster') }}</span>
                                    </div>
                                @endif

                                <h4 class="text-xl font-semibold text-white mb-2">{{ $kegiatan->nama_kegiatan }}</h4>
                                <p class="text-gray-300 text-sm mb-1">
                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d M Y H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d M Y H:i') }}
                                </p>
                                <p class="text-gray-300 text-sm mb-1">{{ $kegiatan->kategori->nama_kategori ?? 'N/A' }}</p>
                                <p class="text-gray-300 text-sm mb-4">{{ __('Poin TAK:') }} {{ $kegiatan->poin_tak }}</p>

                                <a href="{{ route('user.kegiatan.show', $kegiatan->id) }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    {{ __('Lihat Detail') }}
                                </a>
                            </div>
                        @empty
                            <div class="md:col-span-full bg-gray-700 p-6 rounded-lg shadow-md text-center">
                                <p class="text-lg text-gray-300">{{ __('Tidak ada kegiatan yang ditemukan.') }}</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $kegiatans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

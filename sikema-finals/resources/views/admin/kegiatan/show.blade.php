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
                    <h3 class="text-2xl font-bold mb-6">{{ $kegiatan->nama_kegiatan }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Nama Kegiatan --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Nama Kegiatan:</dt>
                            <dd class="text-lg font-medium">{{ $kegiatan->nama_kegiatan }}</dd>
                        </div>

                        {{-- Kategori Kegiatan --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Kategori:</dt>
                            <dd class="text-lg font-medium">{{ $kegiatan->kategori->nama_kategori ?? 'N/A' }}</dd>
                        </div>

                        {{-- Deskripsi Kegiatan --}}
                        <div class="md:col-span-2 bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Deskripsi:</dt>
                            <dd class="text-lg font-medium">{{ $kegiatan->deskripsi }}</dd>
                        </div>

                        {{-- Tempat Pelaksanaan --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Tempat Pelaksanaan:</dt>
                            <dd class="text-lg font-medium">{{ $kegiatan->tempat }}</dd>
                        </div>

                        {{-- Tanggal & Waktu Mulai --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Tanggal & Waktu Mulai:</dt>
                            <dd class="text-lg font-medium">{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d M Y H:i') }}</dd>
                        </div>

                        {{-- Tanggal & Waktu Selesai --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Tanggal & Waktu Selesai:</dt>
                            <dd class="text-lg font-medium">{{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d M Y H:i') }}</dd>
                        </div>

                        {{-- Poin TAK --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Poin TAK:</dt>
                            <dd class="text-lg font-medium">{{ $kegiatan->poin_tak }}</dd>
                        </div>

                        {{-- Dibuat Pada --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Dibuat Pada:</dt>
                            <dd class="text-lg font-medium">{{ \Carbon\Carbon::parse($kegiatan->created_at)->format('d M Y H:i') }}</dd>
                        </div>

                        {{-- Diperbarui Pada --}}
                        <div class="bg-gray-700 p-4 rounded-md flex flex-col justify-between">
                            <dt class="text-sm font-medium text-gray-300 uppercase mb-1">Diperbarui Pada:</dt>
                            <dd class="mt-1 text-lg leading-6 text-white sm:col-span-2 sm:mt-0">{{ \Carbon\Carbon::parse($kegiatan->updated_at)->format('d M Y H:i') }}</dd>
                        </div>
                    </div>

                    <div class="mt-8 bg-gray-700 p-6 rounded-lg text-center max-w-md mx-auto">
                        <dt class="text-lg font-semibold text-gray-300 uppercase mb-4">Poster Kegiatan:</dt>
                        <dd class="mt-1 text-lg leading-6 text-white">
                            @if ($kegiatan->poster_kegiatan)
                                <img src="{{ asset('storage/' . $kegiatan->poster_kegiatan) }}" alt="Poster Kegiatan" class="mx-auto max-w-full h-auto rounded-lg shadow-lg object-contain" style="max-height: 400px;">
                            @else
                                <p class="text-xl text-gray-400">Tidak ada poster tersedia.</p>
                            @endif
                        </dd>
                    </div>

                    <div class="flex justify-end mt-8">
                        <a href="{{ route('admin.kegiatan.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150
                            bg-gray-600 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            {{ __('Kembali') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

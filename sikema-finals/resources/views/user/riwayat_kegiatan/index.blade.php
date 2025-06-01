<x-app-layout>
    <x-slot name="header">
        {{-- Judul halaman dengan latar belakang abu gelap dan teks putih --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-gray-700 p-4 rounded-lg">
            {{ __('Riwayat Pendaftaran Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama: Latar belakang abu gelap, bayangan, sudut melengkung --}}
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- Mengubah bg-white menjadi bg-gray-800 --}}
                <div class="p-6 text-white"> {{-- Mengubah text-gray-900 menjadi text-white --}}
                    {{-- Judul bagian "Kegiatan yang Telah Anda Daftar" --}}
                    <h3 class="text-lg font-medium mb-4 text-gray-200">Kegiatan yang Telah Anda Daftar</h3> {{-- Mengubah text-gray-900 menjadi text-gray-200 --}}

                    {{-- Pesan sukses/error --}}
                    @if (session('success'))
                        <div class="bg-green-700 border border-green-600 text-white px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-700 border border-red-600 text-white px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-gray-700 rounded-lg shadow"> {{-- Latar belakang tabel abu gelap --}}
                        <table class="min-w-full divide-y divide-gray-600"> {{-- Garis pembagi tabel abu lebih gelap --}}
                            <thead class="bg-gray-700"> {{-- Header tabel abu gelap --}}
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Nama Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Tanggal Mulai
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Status Pendaftaran
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Tanggal Daftar
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700"> {{-- Body tabel abu lebih gelap, garis pembagi abu lebih gelap --}}
                                @forelse ($riwayatKegiatans as $pendaftaran)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white"> {{-- Mengubah text-gray-900 menjadi text-white --}}
                                            <a href="{{ route('user.kegiatan.show', $pendaftaran->kegiatan->id) }}" class="text-white-400 hover:text-white-500"> {{-- Mengubah warna link --}}
                                                {{ $pendaftaran->kegiatan->nama_kegiatan }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $pendaftaran->kegiatan->tanggal_mulai->format('d M Y H:i') }}</td> {{-- Mengubah text-gray-900 menjadi text-white --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($pendaftaran->status_pendaftaran == 'terdaftar') bg-blue-800 text-white
                                                @elseif($pendaftaran->status_pendaftaran == 'selesai') bg-green-800 text-white
                                                @elseif($pendaftaran->status_pendaftaran == 'pending') bg-yellow-800 text-white
                                                @else bg-red-800 text-white @endif">
                                                {{ ucfirst($pendaftaran->status_pendaftaran) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $pendaftaran->created_at->format('d M Y H:i') }}</td> {{-- Mengubah text-gray-900 menjadi text-white --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-400">Anda belum mendaftar kegiatan apapun.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $riwayatKegiatans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

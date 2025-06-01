<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Input TAK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Daftar TAK yang Anda Input</h3>
                        <a href="{{ route('user.tak.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Input TAK Baru
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penyelenggara
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Poin Didapat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status Verifikasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Bukti
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-600 divide-y divide-gray-200">
                                @forelse ($taks as $tak)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($tak->kegiatan)
                                                {{ $tak->kegiatan->nama_kegiatan }} (Internal)
                                            @else
                                                {{ $tak->nama_kegiatan_external ?? '-' }} (Eksternal)
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($tak->kegiatan)
                                                Kampus
                                            @else
                                                {{ $tak->penyelenggara_external ?? '-' }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($tak->kegiatan)
                                                {{ $tak->kegiatan->tanggal_mulai->format('d M Y') }}
                                            @else
                                                {{ $tak->tanggal_kegiatan_external ? $tak->tanggal_kegiatan_external->format('d M Y') : '-' }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $tak->poin_didapat }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($tak->status_verifikasi == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($tak->status_verifikasi == 'diverifikasi') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($tak->status_verifikasi) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($tak->bukti_sertifikat)
                                                <a href="{{ asset($tak->bukti_sertifikat) }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                    <i class="fa-solid fa-eye mr-1"></i> Lihat Bukti
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-white-800">Anda belum menginput TAK apapun.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $taks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

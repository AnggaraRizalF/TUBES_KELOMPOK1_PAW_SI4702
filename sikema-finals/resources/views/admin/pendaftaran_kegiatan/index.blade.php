<x-app-layout>
    <x-slot name="header">
        {{-- Judul halaman dengan latar belakang abu gelap dan teks putih --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-gray-700 p-4 rounded-lg">
            {{ __('Verifikasi Pendaftaran Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama: Latar belakang abu gelap, bayangan, sudut melengkung --}}
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    {{-- Teks "Pendaftaran Menunggu Verifikasi" di luar kotak abu --}}
                    <p class="text-lg font-semibold mb-4">
                        {{ __('Pendaftaran Menunggu Verifikasi') }}
                    </p>

                    {{-- Menggunakan @forelse untuk menampilkan tabel jika ada pendaftaran, atau pesan jika tidak ada --}}
                    @forelse ($pendaftarans as $pendaftaran)
                        {{-- Jika ada pendaftaran, kotak pesan akan disembunyikan dan tabel ini akan muncul --}}
                        <div class="overflow-x-auto bg-gray-700 rounded-lg shadow mt-6">
                            <table class="min-w-full divide-y divide-gray-600">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            {{ __('Nama Kegiatan') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            {{ __('Pengguna') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            {{ __('Aksi') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800 divide-y divide-gray-700">
                                    {{-- Contoh data baris (gunakan loop foreach di sini untuk $pendaftarans) --}}
                                    {{-- Baris ini akan diulang untuk setiap pendaftaran --}}
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                            {{ $pendaftaran->kegiatan->nama_kegiatan ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            {{ $pendaftaran->user->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-300">
                                            {{ $pendaftaran->status ?? 'Menunggu' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.pendaftaran-kegiatan.verify', $pendaftaran->id) }}" class="text-green-400 hover:text-green-600 mr-3">
                                                {{ __('Verifikasi') }}
                                            </a>
                                            <a href="{{ route('admin.pendaftaran-kegiatan.reject', $pendaftaran->id) }}" class="text-red-400 hover:text-red-600">
                                                {{ __('Tolak') }}
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- Hentikan loop setelah baris pertama untuk contoh ini, dalam aplikasi nyata ini akan menjadi bagian dari loop foreach --}}
                        @break
                    @empty
                        {{-- Kontainer pesan verifikasi jika tidak ada pendaftaran --}}
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md text-center">
                            <p class="text-gray-300">
                                {{ __('Tidak ada pendaftaran kegiatan yang menunggu verifikasi.') }}
                            </p>
                            <p class="text-gray-300">
                                {{ __('Semua pendaftaran telah diverifikasi atau tidak ada pendaftaran baru.') }}
                            </p>
                        </div>
                    @endforelse

                    {{-- Jika ada pagination untuk pendaftaran, Anda bisa menambahkannya di sini --}}
                    {{-- Asumsi $pendaftarans adalah instance dari LengthAwarePaginator --}}
                    @if (isset($pendaftarans) && $pendaftarans->hasPages())
                        <div class="mt-4">
                            {{ $pendaftarans->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

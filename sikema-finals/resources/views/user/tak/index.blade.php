<x-app-layout>
    <x-slot name="header">
        {{-- Judul halaman dengan latar belakang abu gelap dan teks putih --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-gray-700 p-4 rounded-lg">
            {{ __('Riwayat Input TAK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama: Latar belakang abu gelap, bayangan, sudut melengkung --}}
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    {{-- Bagian pencarian dan input TAK baru --}}
                    <div class="flex flex-col md:flex-row items-center justify-between mb-6 space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-2 w-full md:w-auto">
                            {{-- Input pencarian dengan latar belakang abu gelap dan teks putih --}}
                            <input type="text" placeholder="Cari nama kegiatan..." class="form-input rounded-md shadow-sm block w-full md:w-64 bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" />
                            {{-- Tombol cari dengan latar belakang abu gelap --}}
                            <button type="button" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                {{ __('Cari') }}
                            </button>
                        </div>
                        {{-- Tombol input TAK baru dengan latar belakang hijau --}}
                        <a href="{{ route('user.input-tak.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            {{ __('Input TAK Baru') }}
                        </a>
                    </div>

                    {{-- Tabel riwayat input TAK --}}
                    <div class="overflow-x-auto bg-gray-700 rounded-lg shadow"> {{-- Latar belakang tabel abu gelap --}}
                        <table class="min-w-full divide-y divide-gray-600"> {{-- Garis pembagi tabel abu lebih gelap --}}
                            <thead class="bg-gray-700"> {{-- Header tabel abu gelap --}}
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Nama Kegiatan') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Penyelenggara') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Tanggal Kegiatan') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Status Verifikasi') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Aksi') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700"> {{-- Body tabel abu lebih gelap, garis pembagi abu lebih gelap --}}
                                @forelse ($riwayatTaks as $tak) {{-- Asumsi variabel adalah $riwayatTaks --}}
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                            {{ $tak->nama_kegiatan }} {{-- Sesuaikan dengan kolom di model TAK Anda --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            {{ $tak->penyelenggara }} {{-- Sesuaikan dengan kolom di model TAK Anda --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            {{ \Carbon\Carbon::parse($tak->tanggal_kegiatan)->format('d M Y') }} {{-- Sesuaikan dengan kolom di model TAK Anda --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($tak->status_verifikasi == 'terverifikasi') bg-green-700 text-white
                                                @elseif($tak->status_verifikasi == 'menunggu') bg-yellow-700 text-white
                                                @else bg-red-700 text-white @endif">
                                                {{ ucfirst($tak->status_verifikasi) }} {{-- Sesuaikan dengan kolom di model TAK Anda --}}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('user.riwayat-tak.show', $tak->id) }}" class="text-blue-400 hover:text-blue-500 mr-3">
                                                {{ __('Detail') }}
                                            </a>
                                            <a href="{{ route('user.riwayat-tak.edit', $tak->id) }}" class="text-indigo-400 hover:text-indigo-600 mr-3">
                                                {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('user.riwayat-tak.destroy', $tak->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus input TAK ini?')">
                                                    {{ __('Hapus') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-400">
                                            {{ __('Anda belum menginput TAK apapun.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (jika ada) --}}
                    <div class="mt-4">
                        {{ $riwayatTaks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

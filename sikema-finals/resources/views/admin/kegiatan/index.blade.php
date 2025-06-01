<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 bg-gray-800 rounded-lg shadow-lg text-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Manajemen Kegiatan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium">Daftar Kegiatan</h3>
                    <a href="{{ route('admin.kegiatan.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Kegiatan
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-700 border border-green-800 text-white px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full divide-y divide-gray-700">
                        <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Nama Kegiatan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Tanggal Mulai
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Poin TAK
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse ($kegiatans as $kegiatan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kegiatan->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kegiatan->nama_kegiatan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kegiatan->kategori->nama_kategori ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kegiatan->tanggal_mulai->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kegiatan->poin_tak }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.kegiatan.show', $kegiatan->id) }}" class="text-blue-400 hover:text-blue-300 mr-3">Detail</a>
                                        <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}" class="text-indigo-400 hover:text-indigo-300 mr-3">Edit</a>
                                        <form action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini? Semua pendaftaran terkait juga akan terhapus!')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-300">Belum ada kegiatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $kegiatans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


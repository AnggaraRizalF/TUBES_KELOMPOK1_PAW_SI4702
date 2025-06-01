

<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 bg-gray-800 rounded-lg shadow-lg text-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Manajemen Kategori Kegiatan') }}
            </h2>
        </div>
        {{-- END: KOTAK JUDUL --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-white">Daftar Kategori Kegiatan</h3> 
                    <a href="{{ route('admin.kategori-kegiatan.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Kategori
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-700 border border-green-800 text-white px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto rounded-lg"> 
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700"> 
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Nama Kategori
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700"> 
                            @forelse ($kategoriKegiatans as $kategori)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kategori->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $kategori->deskripsi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.kategori-kegiatan.show', $kategori->id) }}" class="text-blue-400 hover:text-blue-300 mr-3">Detail</a>
                                        <a href="{{ route('admin.kategori-kegiatan.edit', $kategori->id) }}" class="text-indigo-400 hover:text-indigo-300 mr-3">Edit</a>
                                        <form action="{{ route('admin.kategori-kegiatan.destroy', $kategori->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-300">Belum ada kategori kegiatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $kategoriKegiatans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

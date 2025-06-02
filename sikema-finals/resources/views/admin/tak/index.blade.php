<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 bg-gray-800 rounded-lg shadow-lg text-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Verifikasi Data TAK') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">

                @if (session('success'))
                    <div class="bg-green-700 border border-green-800 text-white px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Berhasil!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.196l-2.651 2.652a1.2 1.2 0 1 1-1.697-1.697L8.303 9.5l-2.651-2.651a1.2 1.2 0 1 1 1.697-1.697L10 7.803l2.651-2.652a1.2 1.2 0 1 1 1.697 1.697L11.696 9.5l2.652 2.651a1.2 1.2 0 0 1 0 1.698z"/>
                            </svg>
                        </span>
                    </div>
                @endif

                <div class="mb-4">
                    <h3 class="text-lg font-medium text-white">Daftar Pengajuan TAK</h3>
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-start items-center mb-6 space-y-4 sm:space-y-0 sm:space-x-4">
                    <form action="{{ route('admin.tak.index') }}" method="GET" class="flex-none">
                        <label for="status-filter" class="sr-only">Filter Status</label>
                        <select name="status" id="status-filter" class="block w-full sm:w-48 rounded-md border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 bg-gray-700 text-white" onchange="this.form.submit()"> {{-- sm:w-48 untuk lebar tetap di desktop --}}
                            <option value="all" {{ $statusFilter == 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="pending" {{ $statusFilter == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diverifikasi" {{ $statusFilter == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                            <option value="ditolak" {{ $statusFilter == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @if ($searchQuery)
                            <input type="hidden" name="search" value="{{ $searchQuery }}">
                        @endif
                    </form>
                    <form action="{{ route('admin.tak.index') }}" method="GET" class="w-full sm:flex-grow">
                        <label for="search-input" class="sr-only">Cari</label>
                        <div class="flex">
                            <input type="text" name="search" id="search-input" class="block w-full rounded-l-md border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 bg-gray-700 text-white placeholder-gray-400" placeholder="Cari..." value="{{ $searchQuery }}">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                        @if ($statusFilter)
                            <input type="hidden" name="status" value="{{ $statusFilter }}">
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-white">
                        <thead class="text-xs uppercase bg-gray-700 text-gray-300">
                            <tr>
                                <th scope="col" class="py-3 px-6">ID</th>
                                <th scope="col" class="py-3 px-6">Nama Kegiatan</th>
                                <th scope="col" class="py-3 px-6">Pengaju</th>
                                <th scope="col" class="py-3 px-6">Tanggal Pengajuan</th>
                                <th scope="col" class="py-3 px-6">Status</th>
                                <th scope="col" class="py-3 px-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($taks as $tak)
                                <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700">
                                    <td class="py-4 px-6 font-medium whitespace-nowrap text-white">{{ $tak->id }}</td>
                                    <td class="py-4 px-6 text-white">
                                        {{ $tak->nama_kegiatan_external ?? ($tak->kegiatan->nama_kegiatan ?? '-') }}
                                    </td>
                                    <td class="py-4 px-6 text-white">{{ $tak->user->name ?? '-' }}</td>
                                    <td class="py-4 px-6 text-white">{{ $tak->created_at->format('d M Y H:i') }}</td>
                                    <td class="py-4 px-6">
                                        @php
                                            $badgeClass = '';
                                            switch ($tak->status_verifikasi) {
                                                case 'pending':
                                                    $badgeClass = 'bg-yellow-600 text-white';
                                                    break;
                                                case 'diverifikasi':
                                                    $badgeClass = 'bg-green-600 text-white';
                                                    break;
                                                case 'ditolak':
                                                    $badgeClass = 'bg-red-600 text-white';
                                                    break;
                                                default:
                                                    $badgeClass = 'bg-gray-600 text-white';
                                                    break;
                                            }
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">{{ ucfirst($tak->status_verifikasi) }}</span>
                                    </td>
                                    <td class="py-4 px-6 flex flex-col sm:flex-row sm:space-x-2 space-y-1 sm:space-y-0">
                                        <a href="{{ route('admin.tak.show', $tak->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <i class="fas fa-eye mr-2"></i> Detail
                                        </a>
                                        @if ($tak->status_verifikasi == 'pending')
                                            <a href="{{ route('admin.tak.edit', $tak->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <i class="fas fa-edit mr-2"></i> Edit Status
                                            </a>
                                        @endif
                                        <form action="{{ route('admin.tak.destroy', $tak->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                <i class="fas fa-trash mr-2"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-gray-800 border-b border-gray-700">
                                    <td colspan="6" class="py-4 px-6 text-center text-gray-300">Tidak ada data TAK yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $taks->appends(['status' => $statusFilter, 'search' => $searchQuery])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

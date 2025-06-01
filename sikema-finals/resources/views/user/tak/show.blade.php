<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail TAK dan Verifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Detail Tambahan Angka Kredit</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="font-bold">Mahasiswa:</p>
                            <p>{{ $tak->user->name ?? 'N/A' }} ({{ $tak->user->email ?? 'N/A' }})</p>
                        </div>
                        <div>
                            <p class="font-bold">Nama Kegiatan:</p>
                            @if($tak->kegiatan_id)
                                <p>{{ $tak->kegiatan->nama_kegiatan ?? 'Kegiatan Internal Dihapus' }} (Internal)</p>
                            @else
                                <p>{{ $tak->nama_kegiatan_external ?? '-' }} (Eksternal)</p>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold">Penyelenggara:</p>
                            <p>{{ $tak->kegiatan ? 'Internal Kampus' : ($tak->penyelenggara_external ?? '-') }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Tanggal Kegiatan:</p>
                            <p>{{ $tak->kegiatan ? ($tak->kegiatan->tanggal_mulai ? $tak->kegiatan->tanggal_mulai->format('d M Y') : '-') : ($tak->tanggal_kegiatan_external ? $tak->tanggal_kegiatan_external->format('d M Y') : '-') }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Poin Didapat:</p>
                            <p>{{ $tak->poin_didapat }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Status Verifikasi:</p>
                            <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full
                                @if($tak->status_verifikasi == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($tak->status_verifikasi == 'diverifikasi') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($tak->status_verifikasi) }}
                            </span>
                        </div>
                        <div>
                            <p class="font-bold">Catatan Admin:</p>
                            <p>{{ $tak->catatan_admin ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Tanggal Input:</p>
                            <p>{{ $tak->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-6 mb-6">
                        <p class="font-bold mb-2">Bukti Sertifikat:</p>
                        @if($tak->bukti_sertifikat)
                            @php
                                $fileExtension = pathinfo($tak->bukti_sertifikat, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                <img src="{{ asset($tak->bukti_sertifikat) }}" alt="Bukti Sertifikat" class="max-w-xl h-auto rounded-lg shadow-md border border-gray-200">
                            @elseif($fileExtension == 'pdf')
                                <a href="{{ asset($tak->bukti_sertifikat) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    <i class="fa-solid fa-file-pdf text-xl mr-2"></i> Lihat Dokumen PDF
                                </a>
                                <p class="text-sm text-gray-500 mt-2">Jika PDF tidak tampil, pastikan browser Anda mendukung pratinjau PDF.</p>
                            @else
                                <p class="text-red-500">Format file tidak didukung untuk pratinjau.</p>
                                <a href="{{ asset($tak->bukti_sertifikat) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium mt-2 block">Unduh File</a>
                            @endif
                        @else
                            <p>Tidak ada bukti sertifikat terunggah.</p>
                        @endif
                    </div>

                    <h4 class="text-xl font-semibold mt-8 mb-4">Form Verifikasi TAK</h4>
                    <form action="{{ route('admin.tak.update', $tak->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="status_verifikasi" :value="__('Status Verifikasi')" />
                            <select id="status_verifikasi" name="status_verifikasi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="pending" {{ old('status_verifikasi', $tak->status_verifikasi) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diverifikasi" {{ old('status_verifikasi', $tak->status_verifikasi) == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                <option value="ditolak" {{ old('status_verifikasi', $tak->status_verifikasi) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <x-input-error :messages="$errors->get('status_verifikasi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="catatan_admin" :value="__('Catatan Admin (Opsional)')" />
                            <textarea id="catatan_admin" name="catatan_admin" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('catatan_admin', $tak->catatan_admin) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Berikan catatan jika TAK ditolak atau ada hal penting lainnya.</p>
                            <x-input-error :messages="$errors->get('catatan_admin')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Perbarui Status') }}
                            </x-primary-button>
                            <a href="{{ route('admin.tak.index') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Kembali') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

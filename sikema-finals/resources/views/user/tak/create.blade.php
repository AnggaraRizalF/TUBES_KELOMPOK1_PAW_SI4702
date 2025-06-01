<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Tambahan Angka Kredit (TAK)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Form Input TAK</h3>

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

                    <form action="{{ route('user.tak.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Bagian untuk kegiatan eksternal --}}
                        <h4 class="font-semibold text-gray-700 mt-6 mb-3">Detail Kegiatan (Jika dari Luar Sistem)</h4>
                        <p class="text-sm text-gray-600 mb-4">Isi bagian ini jika TAK berasal dari kegiatan yang tidak terdaftar di sistem kampus.</p>

                        <div class="mb-4">
                            <x-input-label for="nama_kegiatan_external" :value="__('Nama Kegiatan (Eksternal)')" />
                            <x-text-input id="nama_kegiatan_external" class="block mt-1 w-full" type="text" name="nama_kegiatan_external" :value="old('nama_kegiatan_external')" placeholder="Contoh: Webinar Nasional AI"/>
                            <x-input-error :messages="$errors->get('nama_kegiatan_external')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="penyelenggara_external" :value="__('Penyelenggara (Eksternal)')" />
                            <x-text-input id="penyelenggara_external" class="block mt-1 w-full" type="text" name="penyelenggara_external" :value="old('penyelenggara_external')" placeholder="Contoh: Asosiasi Ilmuwan Indonesia"/>
                            <x-input-error :messages="$errors->get('penyelenggara_external')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tanggal_kegiatan_external" :value="__('Tanggal Kegiatan (Eksternal)')" />
                            <x-text-input id="tanggal_kegiatan_external" class="block mt-1 w-full" type="date" name="tanggal_kegiatan_external" :value="old('tanggal_kegiatan_external')"/>
                            <x-input-error :messages="$errors->get('tanggal_kegiatan_external')" class="mt-2" />
                        </div>

                        <h4 class="font-semibold text-gray-700 mt-6 mb-3">Poin TAK & Bukti Sertifikat</h4>
                        <div class="mb-4">
                            <x-input-label for="poin_didapat" :value="__('Poin TAK yang Didapat')" />
                            <x-text-input id="poin_didapat" class="block mt-1 w-full" type="number" name="poin_didapat" :value="old('poin_didapat')" required min="1" placeholder="Contoh: 10"/>
                            <x-input-error :messages="$errors->get('poin_didapat')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="bukti_sertifikat" :value="__('Unggah Bukti Sertifikat (PDF/Gambar)')" />
                            <input type="file" id="bukti_sertifikat" name="bukti_sertifikat" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" required/>
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maks: 5MB.</p>
                            <x-input-error :messages="$errors->get('bukti_sertifikat')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-500 active:bg-blue-800"> {{-- Mengubah warna Kirim TAK menjadi biru --}}
                                {{ __('Kirim TAK') }}
                            </x-primary-button>
                            <a href="{{ route('user.tak.riwayat') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150
                                bg-red-600 text-white hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"> {{-- Mengubah warna Batal menjadi merah --}}
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

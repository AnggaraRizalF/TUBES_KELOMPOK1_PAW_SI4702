<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kegiatan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="kategori_id" :value="__('Kategori Kegiatan')" />
                            <select id="kategori_id" name="kategori_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm
                                bg-gray-700 text-white" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama_kegiatan" :value="__('Nama Kegiatan')" />
                            <x-text-input id="nama_kegiatan" class="block mt-1 w-full" type="text" name="nama_kegiatan" :value="old('nama_kegiatan')" required autofocus />
                            <x-input-error :messages="$errors->get('nama_kegiatan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi Kegiatan')" />
                            <textarea id="deskripsi" name="deskripsi" rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm
                                bg-gray-700 text-white" required>{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tempat" :value="__('Tempat Pelaksanaan')" />
                            <x-text-input id="tempat" class="block mt-1 w-full" type="text" name="tempat" :value="old('tempat')" required />
                            <x-input-error :messages="$errors->get('tempat')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tanggal_mulai" :value="__('Tanggal & Waktu Mulai')" />
                            <x-text-input id="tanggal_mulai" class="block mt-1 w-full" type="datetime-local" name="tanggal_mulai" :value="old('tanggal_mulai')" required />
                            <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tanggal_selesai" :value="__('Tanggal & Waktu Selesai')" />
                            <x-text-input id="tanggal_selesai" class="block mt-1 w-full" type="datetime-local" name="tanggal_selesai" :value="old('tanggal_selesai')" required />
                            <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="poin_tak" :value="__('Poin TAK (Angka Kredit)')" />
                            <x-text-input id="poin_tak" class="block mt-1 w-full" type="number" name="poin_tak" :value="old('poin_tak')" required min="0" />
                            <x-input-error :messages="$errors->get('poin_tak')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="poster_kegiatan" :value="__('Poster Kegiatan (Opsional)')" />
                            <input type="file" id="poster_kegiatan" name="poster_kegiatan" class="block mt-1 w-full text-sm text-gray-800
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-300 file:text-gray-800
                                hover:file:bg-gray-400"/>
                            <p class="text-xs text-white mt-1">Format: JPG, PNG, GIF. Maks: 2MB.</p>
                            <x-input-error :messages="$errors->get('poster_kegiatan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="bg-gray-600 hover:bg-gray-700 text-white">
                                {{ __('Simpan Kegiatan') }}
                            </x-primary-button>
                            <a href="{{ route('admin.kegiatan.index') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150
                                bg-red-600 text-white hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

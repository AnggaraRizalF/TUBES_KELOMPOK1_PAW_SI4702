<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-gray-700 p-4 rounded-lg">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <div class="flex flex-col md:flex-row items-center justify-between mb-6 space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-2 w-full md:w-auto">
                            <input type="text" placeholder="Cari nama atau email..." class="form-input rounded-md shadow-sm block w-full md:w-64 bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" />
                            <button type="button" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                {{ __('Cari') }}
                            </button>
                        </div>
                        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            {{ __('Tambah Pengguna Baru') }}
                        </a>
                    </div>

                    {{-- Tabel pengguna --}}
                    <div class="overflow-x-auto bg-gray-700 rounded-lg shadow">
                        <table class="min-w-full divide-y divide-gray-600">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Nama') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Email') }}
                                    </th>

                                    {{-- Menambahkan kolom NIM --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('NIM') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('ID Pengguna') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Role') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        {{ __('Aksi') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            {{ $user->email }}
                                        </td>

                                        {{-- Menampilkan data NIM --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            {{ $user->nim ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            {{ $user->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                            {{ $user->role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-400 hover:text-indigo-600 mr-3">
                                                {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                    {{ __('Hapus') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                            {{ __('Tidak ada pengguna ditemukan.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

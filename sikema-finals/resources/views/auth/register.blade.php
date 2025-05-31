<x-guest-layout>
    <div class="flex flex-col items-center justify-center p-6 sm:p-8 md:p-10">
        <div class="mb-6">
            <img src="{{ asset('images/sikema_logo.png') }}" alt="SIKEMA Logo" class="h-24 w-24 rounded-full shadow-lg border-4 border-red-500 transform hover:scale-110 transition-all duration-300">
        </div>

        <h2 class="text-3xl font-bold text-red-400 mb-8 drop-shadow-md text-center">Daftar Akun SIKEMA</h2>

    <form method="POST" action="{{ route('register') }}" class="bg-gray-800 bg-opacity-90 p-8 rounded-lg shadow-xl border border-gray-700 w-full max-w-sm transform hover:scale-105 transition-all duration-300">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-600 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-gray-700 text-white"
                            type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <x-input-label for="nim" :value="__('NIM')" />
            <x-text-input id="nim" class="block mt-1 w-full border-gray-600 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-gray-700 text-white" type="text" name="nim" :value="old('nim')" required autocomplete="nim" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nim')" />
        </div>


        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-600 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-gray-700 text-white"
                            type="email" name="email" :value="old('email')"
                            required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-600 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-gray-700 text-white"
                            type="password" name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-600 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-gray-700 text-white"
                            type="password" name="password_confirmation"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-blue-400 hover:text-blue-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4 bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <div class="flex flex-col items-center justify-center p-6 sm:p-8 md:p-10">
        <div class="mb-6">
            <img src="{{ asset('images/sikema_logo.png') }}" alt="SIKEMA Logo" class="h-24 w-24 rounded-full shadow-lg border-4 border-red-500 transform hover:scale-110 transition-all duration-300"> 
        </div>

        <h2 class="text-3xl font-bold text-red-400 mb-8 drop-shadow-md text-center">Selamat Datang di SIKEMA</h2>
    </div>

    <x-auth-session-status class="mb-4 bg-green-700 border border-green-600 text-white px-4 py-3 rounded relative" :status="session('status')" />
    @error('email')
        <div class="bg-red-700 border border-red-600 text-white px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @enderror
    @error('password')
        <div class="bg-red-700 border border-red-600 text-white px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @enderror


    <form method="POST" action="{{ route('login') }}" class="bg-gray-800 bg-opacity-90 p-8 rounded-lg shadow-xl border border-gray-700 w-full max-w-sm transform hover:scale-105 transition-all duration-300">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-600 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-gray-700 text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-600 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-gray-700 text-white"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-600 text-red-500 shadow-sm focus:ring-red-500" name="remember">
                <span class="ml-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-blue-400 hover:text-blue-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6 text-sm">
            <p class="text-gray-300">Belum punya akun?
                <a href="{{ route('register') }}" class="underline text-red-400 hover:text-red-500">
                    {{ __('Register di sini') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

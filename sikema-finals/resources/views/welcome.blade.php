<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIKEMA | Welcome</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|inter:400,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
        </style>
    </head>
    <body class="bg-gradient-to-b from-red-500 to-white dark:from-red-800 dark:to-gray-900 text-gray-900 dark:text-gray-100 flex flex-col min-h-screen items-center justify-center p-6 font-sans">
        <header class="w-full max-w-4xl text-right mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white dark:text-gray-300 border border-white hover:border-gray-200 rounded-md transition duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-white dark:text-gray-300 border border-transparent hover:border-white rounded-md transition duration-300">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-white text-red-600 rounded-md hover:bg-red-100 transition duration-300">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex flex-col items-center justify-center text-center max-w-2xl mx-auto py-12 px-6 bg-white bg-opacity-90 dark:bg-gray-800 dark:bg-opacity-90 shadow-2xl rounded-lg transform transition-all duration-700 ease-out scale-95 hover:scale-100">
            <div class="mb-8">
                <img src="{{ asset('images/sikema_logo.png') }}" alt="SIKEMA Logo" class="block h-9 w-auto fill-current text-gray-200" style="height: 40px; width: 40px;">

                <h1 class="text-5xl font-extrabold text-red-700 dark:text-red-400 mb-4 tracking-tight">Selamat Datang di <br><span class="block text-red-900 dark:text-red-200 mt-2">SIKEMA</span></h1>
                <p class="text-xl text-gray-800 dark:text-gray-200 leading-relaxed max-w-xl">
                <strong>SIKEMA</strong> adalah platform terintegrasi yang dirancang untuk memudahkan mahasiswa <strong>Telkom University</strong> dalam mengakses dan mengikuti berbagai kegiatan kampus. Kami berkomitmen menyediakan solusi yang informatif, mudah digunakan, dan relevan dengan kebutuhan mahasiswa masa kini.

                </p>
            </div>

            <div class="space-y-4 w-full">
                <p class="text-lg text-gray-700 dark:text-gray-300 font-medium">
                    Pelajari lebih lanjut tentang kami:
                </p>
                <div class="flex justify-center gap-4 mt-6">
                    <a href="{{ url('/about') }}" class="px-8 py-3 bg-red-600 text-white font-bold rounded-full shadow-lg hover:bg-red-700 transition duration-300 transform hover:-translate-y-1">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </main>

        <footer class="mt-16 text-md text-white dark:text-gray-400 drop-shadow-sm">
            &copy; {{ date('Y') }} [SIKEMA. Kelompok 1].
        </footer>
    </body>
</html>


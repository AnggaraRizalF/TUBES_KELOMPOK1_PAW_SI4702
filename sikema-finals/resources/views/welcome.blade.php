<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIKEMA | Welcome</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        {{-- Menggunakan font Instrument Sans dan Inter --}}
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|inter:400,700&display=swap" rel="stylesheet" />

        {{-- Ini adalah cara yang benar untuk memuat CSS dan JS dari Vite/Mix --}}
        {{-- Pastikan kamu menjalankan 'npm install', 'npm run dev', atau 'npm run build' --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Kamu bisa menambahkan CSS kustom tambahan di sini jika ada, tapi lebih baik di resources/css/app.css --}}
        <style>
            /* Kustomisasi kecil jika diperlukan yang tidak bisa diatasi Tailwind */
            /* body {
                font-family: 'Instrument Sans', sans-serif;
            } */
        </style>
    </head>
    {{-- Background gradient untuk body (merah terang ke abu gelap, lebih keren), teks default, dan layout flexbox --}}
    <body class="bg-gradient-to-br from-red-700 via-gray-900 to-black text-white flex flex-col min-h-screen items-center justify-center p-6 font-sans">
        <header class="w-full max-w-4xl text-right mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-medium text-white border border-gray-400 hover:border-gray-200 rounded-full transition duration-300 transform hover:-translate-y-0.5 shadow-md">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-white border border-transparent hover:border-gray-400 rounded-full transition duration-300 transform hover:-translate-y-0.5 shadow-md">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium bg-red-600 text-white rounded-full hover:bg-red-700 transition duration-300 transform hover:-translate-y-0.5 shadow-md">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        {{-- Konten utama halaman selamat datang --}}
        <main class="flex flex-col items-center justify-center text-center max-w-2xl mx-auto py-12 px-8 bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-[3rem] transform transition-all duration-700 ease-out scale-95 hover:scale-100 border border-gray-700"> {{-- Mengubah rounded-xl menjadi rounded-[3rem] untuk sudut yang lebih melengkung --}}
            <div class="mb-8">
                {{-- Ganti path gambar ini dengan path logo Anda yang sesuai tema (putih untuk dark mode, atau logo umum) --}}
                <img src="{{ asset('images/sikema_logo.png') }}" alt="SIKEMA Logo" class="block h-16 w-auto mx-auto mb-6 drop-shadow-lg" style="height: 64px;"> {{-- Logo lebih besar dan di tengah --}}

                <h1 class="text-5xl font-extrabold text-red-400 mb-4 tracking-tight drop-shadow-md">Selamat Datang di <br><span class="block text-red-200 mt-2">SIKEMA</span></h1>
                <p class="text-lg text-gray-200 leading-relaxed max-w-xl">
                <strong>SIKEMA</strong> adalah platform terintegrasi yang dirancang untuk memudahkan mahasiswa <strong>Telkom University</strong> dalam mengakses dan mengikuti berbagai kegiatan kampus. Kami berkomitmen menyediakan solusi yang informatif, mudah digunakan, dan relevan dengan kebutuhan mahasiswa masa kini.
                </p>
            </div>

            <div class="space-y-4 w-full">
                <p class="text-lg text-gray-300 font-medium">
                    Pelajari lebih lanjut tentang kami:
                </p>
                <div class="flex justify-center gap-4 mt-6">
                    <a href="{{ url('/about') }}" class="px-10 py-4 bg-red-600 text-white font-bold rounded-full shadow-lg hover:bg-red-700 transition duration-300 transform hover:-translate-y-1 border border-red-500">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="mt-16 text-md text-gray-400 drop-shadow-sm">
            &copy; {{ date('Y') }} [SIKEMA. Kelompok 1].
        </footer>
    </body>
</html>

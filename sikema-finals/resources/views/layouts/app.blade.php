<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIKEMA</title> {{-- Judul tab browser --}}

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- START CUSTOM STYLE UNTUK TEMA GELAP BERUNSUR TELKOM (ESTETIK) --}}
        <style>
            /* Latar belakang keseluruhan halaman dengan gradasi Telkom */
            body {
                background: linear-gradient(135deg, #1C0105 0%, #2A050A 50%, #1A253A 100%); /* Gradasi dari merah-gelap ke biru-gelap */
                color: #E0E7ED; /* Warna teks default yang terang */
                font-family: 'Poppins', 'Inter', sans-serif;
            }

            /* Definisi warna kustom untuk panel/kartu paling gelap */
            .bg-panel-dark {
                background-color: #1A1E24 !important; /* Warna sangat gelap, hampir hitam dengan hint biru */
            }

            /* Header halaman konten (di bawah navbar) */
            header.bg-white {
                background-color: rgba(30, 40, 55, 0.85) !important; /* Latar belakang gelap transparan */
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important; /* Bayangan yang lebih dalam */
                border-bottom: 1px solid rgba(255, 255, 255, 0.08); /* Garis pemisah halus */
            }
            header .max-w-7xl h2 {
                color: #E0E7ED !important; /* Warna judul header yang terang */
                font-weight: 600;
            }

            /* Kontainer utama untuk konten dashboard (min-h-screen) */
            .min-h-screen {
                background-color: transparent; /* Pastikan tidak ada warna solid di sini */
            }

            /* Area konten utama (main) */
            main {
                background-color: transparent; /* Biarkan transparan, background body akan terlihat */
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            /* Override warna teks default Tailwind yang mungkin masih mengacu ke light mode */
            .text-gray-900 { color: #E0E7ED !important; }
            .text-gray-800 { color: #F0F4F8 !important; }
            .text-gray-700 { color: #B0C4DE !important; }
            .text-gray-600 { color: #87CEEB !important; }
            .text-gray-500 { color: #60A5FA !important; } /* Untuk teks yang lebih redup */


            /* General Shadows and Borders - disesuaikan untuk tema gelap */
            .shadow {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important;
            }
            .shadow-xl {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4), 0 8px 10px -6px rgba(0, 0, 0, 0.2) !important;
            }
            .shadow-lg {
                 box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.15) !important;
            }
            .shadow-md {
                 box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1) !important;
            }
            .border-gray-100 {
                border-color: rgba(255, 255, 255, 0.08) !important;
            }
            .border-gray-200 {
                border-color: rgba(255, 255, 255, 0.15) !important;
            }
            .border-gray-700 {
                border-color: rgba(255, 255, 255, 0.25) !important;
            }

            /* Styling untuk link navigasi di navbar */
            nav a {
                color: #B0C4DE !important; /* Warna abu-abu kebiruan untuk link navigasi */
                font-weight: 500;
                transition: color 0.3s ease;
            }
            nav a:hover {
                color: #FFFFFF !important; /* Warna putih saat hover */
            }
            /* Styling untuk dropdown profil di navbar */
            .py-1.bg-gray-800.border.border-gray-700.rounded-md {
                background-color: #2D3748 !important; /* Warna abu-abu gelap */
                border-color: #3B4A5D !important; /* Border gelap */
            }
            .py-1.bg-gray-800.border.border-gray-700.rounded-md a {
                color: #E0E7ED !important; /* Teks terang */
            }
            .py-1.bg-gray-800.border.border-gray-700.rounded-md a:hover {
                background-color: #3B4A5D !important; /* Hover abu-abu gelap */
                color: #FFFFFF !important; /* Teks putih saat hover */
            }
            /* Untuk logo di authentication-card-logo (jika menggunakan SVG default) */
            .w-20.h-20.fill-current.text-gray-500 {
                filter: brightness(0) invert(1) !important; /* Membuat logo SVG gelap menjadi putih */
                color: #E0E7ED !important; /* Warna default untuk logo SVG di tema gelap */
            }
            /* Jika Anda menggunakan gambar PNG/JPG untuk logo yang tadinya gelap */
            .w-20.h-20.fill-current.text-gray-500 img {
                 filter: brightness(0) invert(1) !important;
            }
             /* Untuk gambar logo di navigation.blade.php */
            nav img {
                filter: brightness(0) invert(1); /* Membuat logo gelap jadi putih untuk navbar gelap */
            }

        </style>
        {{-- END CUSTOM STYLE --}}

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

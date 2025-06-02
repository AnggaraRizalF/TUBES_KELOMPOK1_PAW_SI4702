<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tentang Kami | SIKEMA</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|inter:400,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gradient-to-br from-red-700 via-gray-900 to-black text-white flex flex-col min-h-screen items-center p-6 font-sans">
    <header class="w-full max-w-4xl text-right mb-6">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                <a href="{{ url('/') }}" class="px-5 py-2 text-sm font-medium text-white border border-gray-400 hover:border-gray-200 rounded-full transition duration-300 transform hover:-translate-y-0.5 shadow-md">
                    Beranda
                </a>
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

    <main class="flex flex-col items-center py-12 px-8 max-w-4xl mx-auto flex-grow text-white border-l border-r border-gray-700">
        <h1 class="text-5xl font-extrabold text-red-400 mb-8 tracking-tight drop-shadow-md text-center">Tentang Kami</h1>

        <section class="text-lg text-gray-200 leading-relaxed text-center mb-12 max-w-3xl mx-auto">
            <p class="mb-4">
                Selamat datang di <strong class="text-red-300">SIKEMA</strong>, sebuah inisiatif yang lahir dari visi untuk
                menyediakan solusi manajemen kegiatan kampus yang inovatif dan mudah diakses bagi mahasiswa <strong class="text-red-300">Telkom University</strong>. Sejak 2023, kami telah
                berkomitmen untuk meningkatkan pengalaman akademik dan non-akademik mahasiswa melalui platform yang terintegrasi.
            </p>
            <p class="mb-4">
                Misi kami adalah <strong class="text-red-300">memberdayakan mahasiswa dengan akses mudah ke informasi kegiatan, pendaftaran yang efisien, dan riwayat partisipasi yang transparan</strong>. Kami percaya bahwa <strong class="text-red-300">teknologi harus sederhana, kuat, dan melayani kebutuhan pengguna</strong>, sehingga setiap mahasiswa dapat mencapai potensi penuh mereka di luar kelas.
            </p>
            <p>
                Tim kami terdiri dari para profesional yang berdedikasi dan bersemangat di bidang pengembangan web dan manajemen komunitas. Kami terus berinovasi untuk memberikan pengalaman terbaik dan paling relevan bagi Anda.
            </p>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left mt-8 max-w-4xl mx-auto">
            <div class="p-6 rounded-lg border border-gray-700 bg-gray-800 bg-opacity-70 shadow-lg hover:bg-gray-700 hover:border-gray-600 transition-all duration-300">
                <h2 class="text-2xl font-bold text-red-400 mb-3">Visi Kami</h2>
                <p class="text-gray-300 leading-relaxed">
                    Menjadi platform terdepan yang dikenal karena <strong class="text-red-300">inovasi, keandalan, dan dampak positifnya</strong> dalam manajemen kegiatan kampus, mendukung pengembangan mahasiswa secara holistik.
                </p>
            </div>
            <div class="p-6 rounded-lg border border-gray-700 bg-gray-800 bg-opacity-70 shadow-lg hover:bg-gray-700 hover:border-gray-600 transition-all duration-300">
                <h2 class="text-2xl font-bold text-red-400 mb-3">Nilai-Nilai Kami</h2>
                <ul class="list-disc list-inside text-gray-300 space-y-1">
                    <li><strong class="text-red-300">Inovasi Berkelanjutan</strong>: Terus mencari cara baru untuk meningkatkan layanan.</li>
                    <li><strong class="text-red-300">Fokus pada Pengguna</strong>: Memprioritaskan kebutuhan dan pengalaman mahasiswa.</li>
                    <li><strong class="text-red-300">Integritas dan Transparansi</strong>: Menjaga kepercayaan melalui operasi yang jujur dan terbuka.</li>
                    <li><strong class="text-red-300">Kolaborasi dan Pertumbuhan</strong>: Mendorong kerja sama dan pengembangan diri.</li>
                </ul>
            </div>
        </section>

        {{-- Bagian Tim Kami --}}
        <section class="mt-16 text-center max-w-4xl mx-auto">
            <h2 class="text-4xl font-extrabold text-red-400 mb-10 drop-shadow-md">Tim Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Anggota Tim 1 --}}
                <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-xl border border-gray-700 transform hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('images/PhotoA.jpg') }}" alt="Anggota Tim 1" class="rounded-full w-32 h-32 object-cover mx-auto mb-4 border-4 border-red-500 shadow-md">
                    <h3 class="text-xl font-bold text-white mb-1">Anggara Rizal Febriasnyah</h3>
                    <p class="text-gray-400 text-sm">102022300002</p>
                </div>
                {{-- Anggota Tim 2 --}}
                <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-xl border border-gray-700 transform hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('images/Putri.jpg') }}" alt="Anggota Tim 2" class="rounded-full w-32 h-32 object-cover mx-auto mb-4 border-4 border-red-500 shadow-md">
                    <h3 class="text-xl font-bold text-white mb-1">Aisyah Nur Raihandany Putri</h3>
                    <p class="text-gray-400 text-sm">102022330165</p>
                </div>
                {{-- Anggota Tim 3 --}}
                <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-xl border border-gray-700 transform hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('images/Farras.jpg') }}" alt="Anggota Tim 3" class="rounded-full w-32 h-32 object-cover mx-auto mb-4 border-4 border-red-500 shadow-md">
                    <h3 class="text-xl font-bold text-white mb-1">M. Farras Kamil</h3>
                    <p class="text-gray-400 text-sm">102022300407</p>
                </div>
                {{-- Anggota Tim 4 --}}
                <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-xl border border-gray-700 transform hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('images/Fadhil.jpg') }}" alt="Anggota Tim 4" class="rounded-full w-32 h-32 object-cover mx-auto mb-4 border-4 border-red-500 shadow-md"> {{-- Mengubah images/.jpg menjadi images/Faadhil.jpg --}}
                    <h3 class="text-xl font-bold text-white mb-1">Faadhil Al Ghifari</h3>
                    <p class="text-gray-400 text-sm">102022300425</p>
                </div>
                {{-- Anggota Tim 5 --}}
                <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-xl border border-gray-700 transform hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('images/Nabil.jpg') }}" alt="Anggota Tim 5" class="rounded-full w-32 h-32 object-cover mx-auto mb-4 border-4 border-red-500 shadow-md">
                    <h3 class="text-xl font-bold text-white mb-1">Nabil Athala</h3>
                    <p class="text-gray-400 text-sm">102022300</p>
                </div>
            </div>
        </section>

        <div class="mt-12 text-center max-w-xl mx-auto">
            <p class="text-lg text-gray-300 font-medium mb-4">
                Kami sangat senang Anda telah berkunjung. Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami!
            </p>
            <a href="{{ url('/contact') }}" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-full shadow-lg hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1 border border-blue-500">
                Hubungi Kami
            </a>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="mt-16 text-md text-gray-400 drop-shadow-sm">
        &copy; {{ date('Y') }} SIKEMA. Kelompok 1. Hak Cipta Dilindungi.
    </footer>
</body>
</html>

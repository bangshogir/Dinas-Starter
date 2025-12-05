<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dinas') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass-nav {
            background: rgba(17, 24, 39, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>

    <!-- Dark Mode Init -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body
    class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-white transition-colors duration-300">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 top-0 start-0 glass-nav transition-all duration-300">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse group">
                @if(isset($profil) && $profil->logo_dengan_text)
                    <img src="{{ asset('storage/' . $profil->logo_dengan_text) }}" class="h-16 w-auto object-contain"
                        alt="{{ $profil->nama_dinas }}">
                @else
                    <div class="bg-dinas-primary text-white p-1.5 rounded-lg group-hover:bg-blue-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="self-center text-2xl font-bold whitespace-nowrap dark:text-white text-gray-900 tracking-tight">{{ $profil->nama_dinas ?? 'DINASKITA' }}</span>
                @endif
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse items-center">

                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mr-2 transition-colors">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                @auth
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-white bg-dinas-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-900 font-medium rounded-full text-sm px-5 py-2.5 text-center shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white bg-dinas-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-900 font-medium rounded-full text-sm px-5 py-2.5 text-center shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">Login</a>
                @endauth
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                    <li>
                        <a href="{{ url('/') }}"
                            class="block py-2 px-3 text-dinas-primary bg-transparent md:p-0 md:dark:text-blue-500 font-bold"
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="#services"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Layanan</a>
                    </li>
                    <li>
                        <a href="#prices"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Harga
                            Pasar</a>
                    </li>
                    <li>
                        <a href="#news"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Berita</a>
                    </li>
                    <li>
                        <a href="#stats"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-12 lg:py-16">
            <div class="md:flex md:justify-between">
                <div class="mb-8 md:mb-0 max-w-sm">
                    <a href="{{ url('/') }}" class="flex items-center mb-4">
                        @if(isset($profil) && $profil->logo_dengan_text)
                            <img src="{{ asset('storage/' . $profil->logo_dengan_text) }}"
                                class="h-16 w-auto object-contain" alt="{{ $profil->nama_dinas }}">
                        @else
                            <div class="bg-dinas-primary text-white p-1.5 rounded-lg mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="self-center text-2xl font-bold whitespace-nowrap dark:text-white text-gray-900">{{ $profil->nama_dinas ?? 'DINASKITA' }}</span>
                        @endif
                    </a>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        {{ $profil->sub_title ?? 'Melayani masyarakat dengan integritas, transparansi, dan inovasi. Kami berkomitmen untuk menyediakan layanan publik terbaik dan informasi yang akurat.' }}
                    </p>
                    @if(isset($profil))
                        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                            <p class="mb-1"><span class="font-semibold">Alamat:</span> {{ $profil->alamat_kantor }}</p>
                            <p class="mb-1"><span class="font-semibold">Telp:</span> {{ $profil->nomor_telepon }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $profil->email }}</p>
                        </div>
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-900 uppercase dark:text-white tracking-wider">
                            Layanan</h2>
                        <ul class="text-gray-600 dark:text-gray-400 font-medium space-y-3">
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Perizinan
                                    Online</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Kependudukan</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Pengaduan</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-900 uppercase dark:text-white tracking-wider">
                            Informasi</h2>
                        <ul class="text-gray-600 dark:text-gray-400 font-medium space-y-3">
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Berita
                                    Terkini</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Pengumuman</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Transparansi
                                    Anggaran</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-bold text-gray-900 uppercase dark:text-white tracking-wider">Kontak
                        </h2>
                        <ul class="text-gray-600 dark:text-gray-400 font-medium space-y-3">
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Hubungi
                                    Kami</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">Lokasi
                                    Kantor</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="hover:text-dinas-primary dark:hover:text-blue-500 transition-colors">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-8 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-10" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a
                        href="{{ url('/') }}"
                        class="hover:underline font-semibold text-gray-700 dark:text-gray-300">{{ $profil->nama_dinas ?? 'DinasKita™' }}</a>.
                    All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0 space-x-5">
                    <a href="#" class="text-gray-400 hover:text-dinas-primary dark:hover:text-white transition-colors">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-400 dark:hover:text-white transition-colors">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 17">
                            <path fill-rule="evenodd"
                                d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-600 dark:hover:text-white transition-colors">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.41 2.045c.636-.247 1.363-.416 2.427-.465C8.901 1.534 9.256 1.534 12.315 2zm-.031 1.816c-2.665 0-2.977.012-4.032.06-.971.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.886-.344 1.857-.048 1.055-.06 1.37-.06 4.041v.08c0 2.597.012 2.917.06 3.963.045.971.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.886.3-1.857-.344-1.02-.047-1.336-.06-3.963-.06-2.596 0-2.917.012-3.963.06zm1.842 3.763a4.406 4.406 0 11-4.406 4.406 4.407 4.407 0 014.406-4.406zm0 1.816a2.59 2.59 0 102.59 2.59 2.59 2.59 0 00-2.59-2.59zm4.856-5.042a1.08 1.08 0 11-1.08 1.08 1.08 1.08 0 011.08-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Instagram page</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function () {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>
</body>

</html>
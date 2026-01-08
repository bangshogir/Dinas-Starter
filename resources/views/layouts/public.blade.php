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
            background: #ffffff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
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
    <nav class="sticky w-full z-50 top-0 start-0 transition-all duration-300" x-data="{ scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
        :class="scrolled ? 'glass-nav shadow-lg' : 'bg-transparent'">
        <div class="max-w-screen-xl flex flex-nowrap items-center justify-between mx-auto p-4">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse group shrink-0">
                @if(isset($profil) && $profil->logo_dengan_text)
                    <img src="{{ asset('assets/' . $profil->logo_dengan_text) }}" class="h-12 md:h-16 w-auto object-contain"
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
                        <a href="{{ url('/#services') }}"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Layanan</a>
                    </li>
                    <li>
                        <a href="{{ route('market-prices.index') }}"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Harga
                            Pasar</a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Berita</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-dinas-primary md:p-0 md:dark:hover:text-blue-500 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 transition-colors">Produk</a>
                    </li>
                    <li>
                        <a href="{{ url('/#stats') }}"
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
                            <img src="{{ asset('assets/' . $profil->logo_dengan_text) }}" class="h-16 w-auto object-contain"
                                alt="{{ $profil->nama_dinas }}">
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
                    @if(isset($profil) && !empty($profil->social_media_links))
                        {{-- Facebook --}}
                        @if(isset($profil->social_media_links['facebook']) && $profil->social_media_links['facebook'])
                            <a href="{{ $profil->social_media_links['facebook'] }}" target="_blank"
                                class="text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Facebook</span>
                            </a>
                        @endif

                        {{-- Twitter / X --}}
                        @if(isset($profil->social_media_links['twitter']) && $profil->social_media_links['twitter'])
                            <a href="{{ $profil->social_media_links['twitter'] }}" target="_blank"
                                class="text-gray-400 hover:text-black dark:hover:text-white transition-colors">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M22 4.01c-1 .22-2 .5-3 .5 1.1-6.71 1.1-6.71 1.1-6.71-.46 1.75-1 3.25-1 3.25-.8 3.51-1 3.51-1 3.51C12 4.41 12 4.41 12 4.41c-3.14 1.53-4.48 4.48-7.86 3v1C4.14 7.41 3 4 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"
                                        clip-rule="evenodd" />
                                    <!-- Use standardized Twitter Bird path for 24x24 -->
                                    <path
                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                                </svg>
                                <span class="sr-only">Twitter</span>
                            </a>
                        @endif

                        {{-- Instagram --}}
                        @if(isset($profil->social_media_links['instagram']) && $profil->social_media_links['instagram'])
                            <a href="{{ $profil->social_media_links['instagram'] }}" target="_blank"
                                class="text-gray-400 hover:text-pink-600 dark:hover:text-pink-500 transition-colors">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.59 10.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Instagram</span>
                            </a>
                        @endif

                        {{-- YouTube --}}
                        @if(isset($profil->social_media_links['youtube']) && $profil->social_media_links['youtube'])
                            <a href="{{ $profil->social_media_links['youtube'] }}" target="_blank"
                                class="text-gray-400 hover:text-red-600 dark:hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">YouTube</span>
                            </a>
                        @endif
                    @endif
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
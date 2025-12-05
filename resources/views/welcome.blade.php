<x-public-layout>
    <!-- Hero Section -->
    <section class="relative bg-dinas-primary overflow-hidden">
        <!-- Background Image & Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1577017040065-650ee4d43339?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                alt="Background" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-dinas-primary/90 to-blue-800/70"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 px-4 mx-auto max-w-screen-xl text-center py-32 lg:py-48">
            <span
                class="inline-block py-1 px-3 rounded-full bg-blue-800/50 border border-blue-400/30 text-blue-200 text-sm font-medium mb-6 backdrop-blur-sm">
                Selamat Datang di Portal Resmi Dinas
            </span>
            <h1
                class="mb-6 text-4xl font-extrabold tracking-tight leading-tight text-white md:text-5xl lg:text-7xl drop-shadow-lg">
                Melayani dengan <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-cyan-200">Hati</span>,<br>
                Membangun <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-200">Negeri</span>
            </h1>
            <p
                class="mb-10 text-lg font-normal text-blue-100 lg:text-xl sm:px-16 lg:px-48 max-w-4xl mx-auto leading-relaxed">
                Wujud nyata transparansi dan akuntabilitas pemerintah daerah. Akses layanan publik, informasi terkini,
                dan data statistik dalam satu genggaman.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <a href="#services"
                    class="inline-flex justify-center items-center py-4 px-8 text-lg font-bold text-center text-dinas-primary rounded-full bg-white hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                    Layanan Kami
                    <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                <a href="#news"
                    class="inline-flex justify-center items-center py-4 px-8 text-lg font-bold text-center text-white rounded-full border-2 border-white/30 bg-white/10 hover:bg-white/20 focus:ring-4 focus:ring-gray-400 backdrop-blur-sm transition-all transform hover:-translate-y-0.5">
                    Berita Terkini
                </a>
            </div>
        </div>

        <!-- Shape Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180 z-20">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px] md:h-[100px]" data-name="Layer 1"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="fill-gray-50 dark:fill-gray-900"></path>
            </svg>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="bg-gray-50 dark:bg-gray-900 py-20 lg:py-28 relative">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-12 lg:mb-20 mx-auto text-center">
                <span class="text-dinas-primary font-bold tracking-wider uppercase text-sm">Layanan Unggulan</span>
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white mt-2">Layanan
                    Publik Terpadu</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Kami menghadirkan inovasi layanan digital untuk
                    kemudahan dan kenyamanan masyarakat.</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-10 md:space-y-0">
                <!-- Service 1 -->
                <div
                    class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div
                        class="flex justify-center items-center mb-6 w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 shadow-lg shadow-blue-500/30 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="mb-3 text-2xl font-bold text-gray-900 dark:text-white group-hover:text-dinas-primary transition-colors">
                        Perizinan Online</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4 leading-relaxed">Ajukan perizinan usaha (SIUP, TDP)
                        dan IMB secara online. Pantau status pengajuan real-time.</p>
                    <a href="#"
                        class="inline-flex items-center text-dinas-primary font-semibold hover:text-blue-800 transition-colors">
                        Akses Layanan <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                <!-- Service 2 -->
                <div
                    class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div
                        class="flex justify-center items-center mb-6 w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-700 shadow-lg shadow-green-500/30 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="mb-3 text-2xl font-bold text-gray-900 dark:text-white group-hover:text-green-600 transition-colors">
                        Kependudukan</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4 leading-relaxed">Layanan administrasi kependudukan
                        (KTP-el, KK, Akta) yang cepat, tepat, dan bebas pungli.</p>
                    <a href="#"
                        class="inline-flex items-center text-green-600 font-semibold hover:text-green-800 transition-colors">
                        Akses Layanan <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                <!-- Service 3 -->
                <div
                    class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-purple-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div
                        class="flex justify-center items-center mb-6 w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-700 shadow-lg shadow-purple-500/30 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="mb-3 text-2xl font-bold text-gray-900 dark:text-white group-hover:text-purple-600 transition-colors">
                        Data & Statistik</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4 leading-relaxed">Pusat data daerah yang
                        terintegrasi. Akses data statistik sektoral untuk kebutuhan riset.</p>
                    <a href="#"
                        class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-800 transition-colors">
                        Akses Layanan <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Market Prices Section -->
    <section id="prices" class="bg-white dark:bg-gray-900 py-20 relative">
        <div
            class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25 dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]">
        </div>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 relative z-10">
            <div class="mx-auto max-w-screen-sm text-center mb-12">
                <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-gray-900 dark:text-white">Harga Pasar
                    Terkini</h2>
                <p class="font-light text-gray-500 lg:mb-8 sm:text-xl dark:text-gray-400">Update harga komoditas pangan
                    strategis di pasar tradisional.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Price Card 1 -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Beras Premium</p>
                        <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Rp 15.000</h4>
                        <p class="text-xs text-gray-400 mt-1">per Kg</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            Stabil
                        </span>
                    </div>
                </div>
                <!-- Price Card 2 -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Daging Sapi</p>
                        <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Rp 120.000</h4>
                        <p class="text-xs text-gray-400 mt-1">per Kg</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                            -2%
                        </span>
                    </div>
                </div>
                <!-- Price Card 3 -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Cabai Merah</p>
                        <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Rp 45.000</h4>
                        <p class="text-xs text-gray-400 mt-1">per Kg</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <span
                            class="bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            +5%
                        </span>
                    </div>
                </div>
                <!-- Price Card 4 -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Minyak Goreng</p>
                        <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Rp 14.000</h4>
                        <p class="text-xs text-gray-400 mt-1">per Liter</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            Stabil
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="#" class="text-dinas-primary hover:text-blue-800 font-medium inline-flex items-center">
                    Lihat Semua Harga Komoditas
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="bg-gray-50 dark:bg-gray-800 py-20">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="flex justify-between items-end mb-12">
                <div class="max-w-screen-sm">
                    <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        Berita & Artikel</h2>
                    <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Informasi terbaru seputar kegiatan
                        dan kebijakan pemerintah.</p>
                </div>
                <a href="#"
                    class="hidden md:inline-flex items-center justify-center px-6 py-3 text-base font-medium text-center text-white bg-dinas-primary rounded-full hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    Lihat Semua Berita
                </a>
            </div>
            <div class="grid gap-8 lg:grid-cols-3">
                @forelse($latestArticles as $article)
                    <article
                        class="flex flex-col h-full bg-white rounded-2xl border border-gray-200 shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 dark:bg-gray-800 dark:border-gray-700">
                        <!-- Image Placeholder (Dynamic if available) -->
                        <div class="h-48 bg-gray-200 dark:bg-gray-700 relative overflow-hidden group">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 dark:from-dinas-primary dark:to-gray-800 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-blue-300 dark:text-dinas-primary" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-blue-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                    {{ $article->category->name ?? 'Umum' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex justify-between items-center mb-3 text-gray-500 text-xs">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $article->published_at ? $article->published_at->format('d M Y') : 'Baru saja' }}
                                </span>
                            </div>
                            <h2
                                class="mb-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 hover:text-dinas-primary transition-colors">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="mb-4 font-light text-gray-500 dark:text-gray-400 line-clamp-3 text-sm flex-1">
                                {{ Str::limit($article->excerpt ?? strip_tags($article->content), 120) }}
                            </p>
                            <div
                                class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                                        {{ substr($article->author->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="font-medium text-xs dark:text-white">
                                        {{ $article->author->name ?? 'Admin' }}
                                    </span>
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="inline-flex items-center font-medium text-dinas-primary dark:text-blue-500 hover:text-blue-800 text-sm">
                                    Baca
                                    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada berita</h3>
                        <p class="mt-1 text-sm text-gray-500">Berita terbaru akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-8 text-center md:hidden">
                <a href="#"
                    class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-center text-white bg-dinas-primary rounded-full hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 w-full">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="bg-dinas-primary py-20 relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-10">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
            </svg>
        </div>

        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6 relative z-10">
            <div class="mb-12">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Capaian Kinerja</h2>
                <p class="mt-4 text-lg text-blue-200">Dedikasi kami untuk pembangunan daerah yang berkelanjutan.</p>
            </div>

            <dl class="grid max-w-screen-md gap-8 mx-auto text-white sm:grid-cols-3">
                <div
                    class="flex flex-col items-center justify-center p-6 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10">
                    <dt class="mb-2 text-4xl md:text-5xl font-extrabold text-dinas-secondary">98%</dt>
                    <dd class="font-light text-blue-100">Kepuasan Masyarakat</dd>
                </div>
                <div
                    class="flex flex-col items-center justify-center p-6 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10">
                    <dt class="mb-2 text-4xl md:text-5xl font-extrabold text-dinas-secondary">100+</dt>
                    <dd class="font-light text-blue-100">Proyek Selesai</dd>
                </div>
                <div
                    class="flex flex-col items-center justify-center p-6 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10">
                    <dt class="mb-2 text-4xl md:text-5xl font-extrabold text-dinas-secondary">24/7</dt>
                    <dd class="font-light text-blue-100">Layanan Online</dd>
                </div>
            </dl>
        </div>
    </section>
</x-public-layout>
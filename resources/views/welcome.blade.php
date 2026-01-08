<x-public-layout>
    <!-- Hero Section (JabarProv Style) -->
    <!-- Hero Section (Redesigned) -->
    <section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden bg-gray-900 py-20">
        <!-- Full Screen Background Carousel -->
        <div class="absolute inset-0 z-0"
            x-data="{ activeSlide: 0, totalSlides: {{ $heroSlides->count() > 0 ? $heroSlides->count() : 3 }} }"
            x-init="setInterval(() => { activeSlide = activeSlide === (totalSlides - 1) ? 0 : activeSlide + 1 }, 5000)">

            @if($heroSlides->count() > 0)
                @foreach($heroSlides as $index => $slide)
                    <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">
                        <img src="{{ asset('assets/' . $slide->image_path) }}" alt="{{ $slide->title ?? 'Hero Slide' }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/60"></div>
                    </div>
                @endforeach
            @else
                <!-- Fallback Static Slides -->
                <!-- Slide 1 -->
                <div x-show="activeSlide === 0" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                        alt="Hero Slide 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60"></div>
                </div>

                <!-- Slide 2 -->
                <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">
                    <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                        alt="Hero Slide 2" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60"></div>
                </div>

                <!-- Slide 3 -->
                <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                        alt="Hero Slide 3" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60"></div>
                </div>
            @endif
        </div>

        <!-- Centered Content -->
        <div
            class="relative z-10 px-4 mx-auto max-w-screen-xl text-center w-full flex flex-col items-center justify-center h-full">

            <!-- Logo (Image Only) -->
            <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
                @if(isset($profil) && $profil->logo_tanpa_text)
                    <img src="{{ asset('assets/' . $profil->logo_tanpa_text) }}" alt="Logo Dinas"
                        class="h-24 md:h-32 w-auto drop-shadow-2xl">
                @else
                    <!-- Fallback SVG Logo if no image -->
                    <div class="bg-white/10 p-4 rounded-full backdrop-blur-sm border border-white/20 shadow-2xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Title & Subtitle -->
            <div class="max-w-4xl mx-auto space-y-4 mb-12">
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white drop-shadow-lg leading-tight uppercase"
                    x-data x-intersect="$el.classList.add('animate-fade-in-up')">
                    {{ $profil->nama_dinas ?? 'DINAS PEMERINTAHAN' }}
                </h1>
                <p class="text-lg md:text-2xl text-gray-200 font-light max-w-2xl mx-auto drop-shadow-md" x-data
                    x-intersect="$el.classList.add('animate-fade-in-up', 'delay-200')">
                    {{ $profil->sub_title ?? 'Melayani dengan Sepenuh Hati untuk Kemajuan Daerah' }}
                </p>
            </div>

            <!-- Search & Actions Container -->
            <div class="w-full max-w-3xl mx-auto space-y-8 animate-fade-in-up delay-300">
                <!-- Modern Search Bar -->
                <form action="{{ route('articles.search') }}" method="GET" class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-400 group-focus-within:text-dinas-primary transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="search" name="q"
                        class="block w-full p-5 pl-16 text-lg text-gray-900 border-none rounded-full bg-white/95 focus:bg-white focus:ring-4 focus:ring-blue-500/50 shadow-2xl placeholder-gray-500 backdrop-blur-sm transition-all duration-300 transform group-hover:scale-[1.01]"
                        placeholder="Cari layanan, berita, atau informasi..." required>
                    <button type="submit"
                        class="absolute right-2.5 bottom-2.5 bg-dinas-primary hover:bg-blue-700 text-white font-medium rounded-full text-base px-8 py-3 transition-all shadow-lg hover:shadow-blue-500/30">
                        Cari
                    </button>
                </form>

                <!-- Quick Action Buttons -->
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ url('/#services') }}"
                        class="px-8 py-3 bg-white/10 hover:bg-white/20 text-white border border-white/30 rounded-full font-medium backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        Layanan Kami
                    </a>
                    <a href="#footer"
                        class="px-8 py-3 bg-dinas-secondary hover:bg-amber-700 text-white rounded-full font-medium shadow-lg hover:shadow-amber-500/40 transition-all duration-300 hover:-translate-y-1 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce z-20">
            <a href="#services" class="text-white/70 hover:text-white transition-colors duration-300">
                <svg class="w-8 h-8 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
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
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:space-y-0">
                <!-- Service 1: Pendaftaran Koperasi -->
                <div
                    class="group p-6 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div
                        class="flex justify-center items-center mb-4 w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 shadow-lg shadow-blue-500/30 text-white transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="mb-2 text-xl font-bold text-gray-900 dark:text-white group-hover:text-dinas-primary transition-colors">
                        Pendaftaran Koperasi</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4 text-sm leading-relaxed">Layanan pendirian,
                        perubahan anggaran dasar, dan pembubaran koperasi secara online.</p>
                </div>

                <!-- Service 2: NIB OSS -->
                <div
                    class="group p-6 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div
                        class="flex justify-center items-center mb-4 w-14 h-14 rounded-xl bg-gradient-to-br from-green-500 to-emerald-700 shadow-lg shadow-green-500/30 text-white transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="mb-2 text-xl font-bold text-gray-900 dark:text-white group-hover:text-green-600 transition-colors">
                        NIB OSS</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4 text-sm leading-relaxed">Fasilitasi pembuatan Nomor
                        Induk Berusaha (NIB) melalui sistem OSS RBA.</p>
                </div>

                <!-- Service 3: Pelatihan Digital -->
                <div
                    class="group p-6 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-purple-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div
                        class="flex justify-center items-center mb-4 w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-700 shadow-lg shadow-purple-500/30 text-white transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="mb-2 text-xl font-bold text-gray-900 dark:text-white group-hover:text-purple-600 transition-colors">
                        Pelatihan Digital</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4 text-sm leading-relaxed">Program pelatihan pemasaran
                        digital dan manajemen usaha bagi UMKM.</p>
                </div>

                <!-- Service 4: Bantuan Modal -->
                <div
                    class="group p-6 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-800 dark:border-gray-700 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-amber-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div
                        class="flex justify-center items-center mb-4 w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-700 shadow-lg shadow-amber-500/30 text-white transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="mb-2 text-xl font-bold text-gray-900 dark:text-white group-hover:text-amber-600 transition-colors">
                        Bantuan Modal</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4 text-sm leading-relaxed">Informasi dan fasilitasi
                        akses permodalan KUR dan hibah kompetitif.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sambutan Kepala Dinas Section -->
    <!-- Sambutan Kepala Dinas Section (Whitehall Style) -->
    <section class="bg-gray-50 dark:bg-gray-800 py-24 relative overflow-hidden">
        <div class="py-12 px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="grid gap-16 lg:grid-cols-5 items-center">
                <!-- Left Column: Text -->
                <div class="order-2 lg:order-1 lg:col-span-3">
                    <div
                        class="flex items-center space-x-2 mb-6 text-dinas-primary font-bold tracking-wider uppercase text-sm">
                        <span class="w-12 h-0.5 bg-dinas-primary"></span>
                        <span>Sambutan Kepala Dinas</span>
                    </div>

                    <h2
                        class="mb-8 text-4xl lg:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white leading-tight">
                        Melayani dengan Hati, <br>
                        <span class="text-dinas-primary">Membangun Negeri</span>
                    </h2>

                    <div class="space-y-6 text-lg text-gray-600 dark:text-gray-300 leading-relaxed font-light">
                        <p>
                            "Selamat datang di portal resmi kami. Di era digital ini, kami berkomitmen untuk
                            menghadirkan
                            pelayanan publik yang transparan, akuntabel, dan mudah diakses oleh seluruh lapisan
                            masyarakat."
                        </p>
                        <p>
                            {{ $profil->kepala_dinas_sambutan ?? 'Kami terus berinovasi untuk meningkatkan kualitas layanan dan mendorong pertumbuhan ekonomi daerah melalui pemberdayaan UMKM dan stabilitas harga pasar.' }}
                        </p>
                    </div>

                    <div class="mt-10 border-t border-gray-200 dark:border-gray-700 pt-8">
                        <div>
                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                                {{ $profil->kepala_dinas_nama ?? 'Dr. H. Nama Kepala Dinas, M.Si' }}
                            </h4>
                            <p class="text-dinas-primary font-medium tracking-wide">Kepala Dinas</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Image -->
                <div class="order-1 lg:order-2 relative lg:col-span-2">
                    <!-- Decorator Back Blob -->
                    <div
                        class="absolute -right-20 -top-20 w-72 h-72 bg-blue-100 dark:bg-blue-900/30 rounded-full blur-3xl opacity-50">
                    </div>
                    <div
                        class="absolute -left-10 -bottom-10 w-48 h-48 bg-amber-100 dark:bg-amber-900/30 rounded-full blur-3xl opacity-50">
                    </div>

                    @if(isset($profil) && $profil->kepala_dinas_foto)
                        <img class="relative z-10 w-full aspect-[3/4] object-cover object-top rounded-2xl shadow-2xl"
                            src="{{ asset('assets/' . $profil->kepala_dinas_foto) }}" alt="Kepala Dinas">
                    @else
                        <img class="relative z-10 w-full aspect-[3/4] object-cover object-top rounded-2xl shadow-2xl"
                            src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Kepala Dinas">
                    @endif
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
                @forelse($marketPrices as $price)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $price->commodity_name }}</p>
                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($price->price, 0, ',', '.') }}
                            </h4>
                            <p class="text-xs text-gray-400 mt-1">per {{ $price->unit }}</p>
                        </div>
                        <div class="flex flex-col items-end">
                            @if ($price->trend_status == 'naik')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +{{ $price->trend_percentage }}%
                                </span>
                            @elseif($price->trend_status == 'turun')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                    </svg>
                                    -{{ $price->trend_percentage }}%
                                </span>
                            @else
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    Stabil
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">Belum ada data harga pasar.</div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('market-prices.index') }}"
                    class="text-dinas-primary hover:text-blue-800 font-medium inline-flex items-center">
                    Lihat Semua Harga Komoditas
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Products Section -->
    <section id="products" class="bg-blue-50 dark:bg-gray-900 py-20">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="flex justify-between items-end mb-12">
                <div class="max-w-screen-sm">
                    <span class="text-dinas-primary font-bold tracking-wider uppercase text-sm">Etalase UMKM</span>
                    <h2
                        class="mt-2 mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        Produk Unggulan Daerah</h2>
                    <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Dukung UMKM lokal dengan membeli
                        produk-produk berkualitas.</p>
                </div>
                <a href="{{ route('products.index') }}"
                    class="hidden md:inline-flex items-center justify-center px-6 py-3 text-base font-medium text-center text-white bg-dinas-secondary rounded-full hover:bg-amber-600 focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-900 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    Lihat Semua Produk
                </a>
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2 lg:grid-cols-4">
                @forelse($products as $product)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 group border border-gray-100 dark:border-gray-700 flex flex-col h-full transform hover:-translate-y-1">
                        <!-- Image Container -->
                        <div class="relative h-56">
                            <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                                src="{{ asset('assets/' . $product->image) }}" alt="{{ $product->name }}">

                            <!-- Overlay Gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>

                            <!-- Floating Badge -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-xs font-bold text-dinas-primary px-3 py-1 rounded-full shadow-sm">
                                    <i class="fa-solid fa-store mr-1"></i> {{ $product->seller_name }}
                                </span>
                            </div>

                            <!-- Action on Hover -->
                            <div
                                class="absolute bottom-4 right-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                <span
                                    class="bg-dinas-primary text-white p-3 rounded-full shadow-lg flex items-center justify-center w-10 h-10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 flex-1 flex flex-col">
                            <h3
                                class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 leading-snug group-hover:text-dinas-primary transition-colors">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <div
                                class="mt-auto pt-3 flex items-end justify-between border-t border-gray-50 dark:border-gray-700">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-0.5">Harga</p>
                                    <p class="text-xl font-extrabold text-dinas-secondary">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="text-xs font-semibold text-gray-400 group-hover:text-dinas-primary transition-colors">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">Belum ada produk yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center md:hidden">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-medium text-center text-white bg-dinas-secondary rounded-full hover:bg-amber-600 focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-900">
                    Lihat Semua Produk
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
                <a href="{{ route('articles.index') }}"
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
                                <img src="{{ asset('assets/' . $article->featured_image) }}" alt="{{ $article->title }}"
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
                <a href="{{ route('articles.index') }}"
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

            <dl class="grid max-w-screen-md gap-8 mx-auto text-white sm:grid-cols-3" x-data="{
                    counters: [
                        { current: 0, target: 150, label: 'Koperasi Aktif' },
                        { current: 0, target: 5000, label: 'UMKM Terdaftar' },
                        { current: 0, target: 10000000, label: 'Nilai Perdagangan', prefix: 'Rp ' }
                    ],
                    startCounting() {
                        this.counters.forEach(counter => {
                            let duration = 2000;
                            let stepTime = 20;
                            let steps = duration / stepTime;
                            let increment = counter.target / steps;
                            let timer = setInterval(() => {
                                counter.current += increment;
                                if (counter.current >= counter.target) {
                                    counter.current = counter.target;
                                    clearInterval(timer);
                                }
                            }, stepTime);
                        });
                    }
                }" x-init="setTimeout(() => startCounting(), 500)">
                <div
                    class="flex flex-col items-center justify-center p-6 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10 transform hover:scale-105 transition-transform">
                    <dt class="mb-2 text-4xl md:text-5xl font-extrabold text-dinas-secondary"
                        x-text="Math.floor(counters[0].current) + '+'"></dt>
                    <dd class="font-light text-blue-100">Koperasi Aktif</dd>
                </div>
                <div
                    class="flex flex-col items-center justify-center p-6 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10 transform hover:scale-105 transition-transform">
                    <dt class="mb-2 text-4xl md:text-5xl font-extrabold text-dinas-secondary"
                        x-text="Math.floor(counters[1].current).toLocaleString('id-ID') + '+'"></dt>
                    <dd class="font-light text-blue-100">UMKM Terdaftar</dd>
                </div>
                <div
                    class="flex flex-col items-center justify-center p-6 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10 transform hover:scale-105 transition-transform">
                    <dt class="mb-2 text-2xl md:text-3xl font-extrabold text-dinas-secondary"
                        x-text="'Rp ' + (Math.floor(counters[2].current)/1000000).toFixed(0) + 'M+'"></dt>
                    <dd class="font-light text-blue-100">Nilai Perdagangan</dd>
                </div>
            </dl>
        </div>
    </section>

    <!-- Mitra Strategis Section -->
    <section class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="text-center mb-12">
                <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mitra Strategis</h2>
                <p class="text-gray-500 dark:text-gray-400">Berkolaborasi untuk kemajuan ekonomi daerah.</p>
            </div>
            <div
                class="grid grid-cols-2 gap-8 text-gray-500 sm:gap-12 md:grid-cols-3 lg:grid-cols-6 dark:text-gray-400">
                <a href="#"
                    class="flex justify-center items-center opacity-60 hover:opacity-100 transition-all duration-300 grayscale hover:grayscale-0">
                    <img src="https://placehold.co/150x60/e5e7eb/1f2937?text=Kemenkop+UKM" alt="Kemenkop UKM"
                        class="h-12 object-contain">
                </a>
                <a href="#"
                    class="flex justify-center items-center opacity-60 hover:opacity-100 transition-all duration-300 grayscale hover:grayscale-0">
                    <img src="https://placehold.co/150x60/e5e7eb/1f2937?text=Kemendag" alt="Kemendag"
                        class="h-12 object-contain">
                </a>
                <a href="#"
                    class="flex justify-center items-center opacity-60 hover:opacity-100 transition-all duration-300 grayscale hover:grayscale-0">
                    <img src="https://placehold.co/150x60/e5e7eb/1f2937?text=Kemenperin" alt="Kemenperin"
                        class="h-12 object-contain">
                </a>
                <a href="#"
                    class="flex justify-center items-center opacity-60 hover:opacity-100 transition-all duration-300 grayscale hover:grayscale-0">
                    <img src="https://placehold.co/150x60/e5e7eb/1f2937?text=Bank+Daerah" alt="Bank Daerah"
                        class="h-12 object-contain">
                </a>
                <a href="#"
                    class="flex justify-center items-center opacity-60 hover:opacity-100 transition-all duration-300 grayscale hover:grayscale-0">
                    <img src="https://placehold.co/150x60/e5e7eb/1f2937?text=Dekranasda" alt="Dekranasda"
                        class="h-12 object-contain">
                </a>
                <a href="#"
                    class="flex justify-center items-center opacity-60 hover:opacity-100 transition-all duration-300 grayscale hover:grayscale-0">
                    <img src="https://placehold.co/150x60/e5e7eb/1f2937?text=KADIN" alt="KADIN"
                        class="h-12 object-contain">
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
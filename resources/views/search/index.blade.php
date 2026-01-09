<x-public-layout>
    <!-- Search Results Header -->
    <section class="bg-gradient-to-br from-dinas-primary to-blue-700 py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Hasil Pencarian</h1>
                <p class="text-blue-100 text-lg">
                    Menampilkan <span class="font-semibold text-white">{{ $totalResults }}</span> hasil untuk
                    "<span class="font-semibold text-white">{{ $query }}</span>"
                </p>
            </div>

            <!-- Search Form -->
            <div class="mt-8 max-w-2xl mx-auto">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="search" name="q" value="{{ $query }}"
                        class="block w-full p-4 pl-12 text-gray-900 border-none rounded-full bg-white focus:ring-4 focus:ring-blue-300 shadow-xl"
                        placeholder="Cari artikel, produk, atau informasi...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button type="submit"
                        class="absolute right-2 bottom-2 bg-dinas-primary hover:bg-blue-800 text-white font-medium rounded-full text-sm px-6 py-2 transition-colors">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-screen-xl mx-auto px-4">
            @if($totalResults === 0)
                <!-- No Results -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <svg class="w-24 h-24 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Tidak ada hasil ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400">Coba gunakan kata kunci yang berbeda atau lebih umum.</p>
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-dinas-primary text-white rounded-full hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Articles Results -->
                    @if($articles->count() > 0)
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Artikel ({{ $articles->count() }})
                                </h2>
                            </div>
                            <div class="space-y-4">
                                @foreach($articles as $article)
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                        class="block p-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-700 transition-all">
                                        <div class="flex gap-4">
                                            @if($article->featured_image)
                                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                    class="w-20 h-20 object-cover rounded-lg shrink-0" alt="{{ $article->title }}">
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 rounded mb-2">
                                                    {{ $article->category->name ?? 'Berita' }}
                                                </span>
                                                <h3 class="font-semibold text-gray-800 dark:text-white line-clamp-2 mb-1">
                                                    {{ $article->title }}</h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                                    {{ $article->excerpt }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @if($articles->count() >= 10)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('articles.search', ['q' => $query]) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium">
                                        Lihat semua artikel →
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Products Results -->
                    @if($products->count() > 0)
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Produk UMKM
                                    ({{ $products->count() }})</h2>
                            </div>
                            <div class="space-y-4">
                                @foreach($products as $product)
                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="block p-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-green-300 dark:hover:border-green-700 transition-all">
                                        <div class="flex gap-4">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="w-20 h-20 object-cover rounded-lg shrink-0" alt="{{ $product->name }}">
                                            @else
                                                <div
                                                    class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-lg shrink-0 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-medium text-green-600 bg-green-100 dark:bg-green-900/30 dark:text-green-400 rounded mb-2">
                                                    {{ $product->category->name ?? 'Produk' }}
                                                </span>
                                                <h3 class="font-semibold text-gray-800 dark:text-white line-clamp-1 mb-1">
                                                    {{ $product->name }}</h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1">
                                                    {{ $product->seller_name }}</p>
                                                @if($product->price)
                                                    <p class="text-sm font-semibold text-green-600 dark:text-green-400 mt-1">Rp
                                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @if($products->count() >= 10)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('products.index', ['search' => $query]) }}"
                                        class="text-green-600 hover:text-green-800 font-medium">
                                        Lihat semua produk →
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Market Prices Results -->
                @if($marketPrices->count() > 0)
                <div class="mt-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Harga Pasar ({{ $marketPrices->count() }})</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($marketPrices as $price)
                        <a href="{{ route('market-prices.index') }}"
                            class="block p-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-orange-300 dark:hover:border-orange-700 transition-all">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-white mb-1">{{ $price->commodity_name }}</h3>
                                    <p class="text-lg font-bold text-orange-600 dark:text-orange-400">
                                        Rp {{ number_format($price->price, 0, ',', '.') }}/{{ $price->unit }}
                                    </p>
                                </div>
                                @if($price->trend_status === 'naik')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-sm font-medium text-red-600 bg-red-100 dark:bg-red-900/30 dark:text-red-400 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    {{ $price->trend_percentage }}%
                                </span>
                                @elseif($price->trend_status === 'turun')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-sm font-medium text-green-600 bg-green-100 dark:bg-green-900/30 dark:text-green-400 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                    </svg>
                                    {{ $price->trend_percentage }}%
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-1 text-sm font-medium text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-400 rounded-full">
                                    Stabil
                                </span>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('market-prices.index') }}" class="text-orange-600 hover:text-orange-800 font-medium">
                            Lihat semua harga pasar →
                        </a>
                    </div>
                </div>
                @endif
            @endif
        </div>
    </section>
</x-public-layout>
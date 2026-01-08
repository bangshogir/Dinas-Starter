@props(['popularProducts' => null, 'categories' => [], 'productCategories' => [], 'recentArticles' => [], 'profil' => \App\Models\ProfilDinas::first(), 'marketPrices' => \App\Models\MarketPrice::latest()->get()])

<div class="space-y-8 sticky top-24">

    <!-- Search Widget -->
    <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-lg dark:bg-gray-800 dark:border-gray-700">
        <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white border-l-4 border-dinas-primary pl-3">Pencarian
        </h3>
        <form action="{{ route('articles.search') }}" method="GET" class="relative group">
            <div class="relative">
                <input type="search" name="q"
                    class="block w-full p-4 pl-12 text-sm text-gray-900 border border-gray-200 rounded-full bg-gray-50 focus:ring-4 focus:ring-blue-500/10 focus:border-dinas-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all duration-300"
                    placeholder="Cari artikel..." required>
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-dinas-primary transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button type="submit"
                    class="absolute text-white bg-dinas-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-xs px-4 py-2 right-2 bottom-2 dark:focus:ring-blue-900 transition-all shadow-md hover:shadow-blue-500/30">Cari</button>
            </div>
        </form>
    </div>

    <!-- Kepala Dinas Widget -->
    @if($profil && ($profil->kepala_dinas_nama || $profil->kepala_dinas_foto))
        <div
            class="group relative overflow-hidden rounded-2xl bg-white shadow-lg border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
            <div class="relative h-24 bg-dinas-primary">
                <div
                    class="absolute -bottom-10 left-1/2 h-20 w-20 -translate-x-1/2 rounded-full border-4 border-white bg-white dark:border-gray-800 dark:bg-gray-800 overflow-hidden shadow-md">
                    @if($profil->kepala_dinas_foto)
                        <img src="{{ asset('assets/' . $profil->kepala_dinas_foto) }}" alt="Foto Kepala Dinas"
                            class="h-full w-full object-cover" />
                    @else
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                            alt="Default Kepala Dinas" class="h-full w-full object-cover" />
                    @endif
                </div>
            </div>
            <div class="pt-12 pb-6 px-6 text-center">
                <h3 class="mb-1 text-lg font-bold text-gray-900 dark:text-white">
                    {{ $profil->kepala_dinas_nama ?? 'Kepala Dinas' }}
                </h3>
                <p class="text-xs font-medium text-dinas-primary uppercase tracking-wider">Kepala Dinas</p>
                @if($profil->kepala_dinas_sambutan)
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 italic line-clamp-3">
                        "{{ Str::limit($profil->kepala_dinas_sambutan, 100) }}"
                    </p>
                @endif
            </div>
        </div>
    @endif

    <!-- Info Harga Pasar Widget -->
    @if($marketPrices->count() > 0)
        <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white border-l-4 border-dinas-primary pl-3">Info Harga
                Pasar</h3>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($marketPrices as $price)
                    <div class="py-3 flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $price->commodity_name }}</p>
                            <p class="text-xs text-gray-500">per {{ $price->unit }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($price->price, 0, ',', '.') }}
                            </p>
                            @if ($price->trend_status == 'naik')
                                <span class="text-[10px] text-red-600 flex items-center justify-end">
                                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    {{ $price->trend_percentage }}%
                                </span>
                            @elseif($price->trend_status == 'turun')
                                <span class="text-[10px] text-green-600 flex items-center justify-end">
                                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                    </svg>
                                    {{ $price->trend_percentage }}%
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 text-center">
                <a href="{{ url('/#prices') }}" class="text-xs font-medium text-dinas-primary hover:underline">Lihat
                    Selengkapnya &rarr;</a>
            </div>
        </div>
    @endif

    <!-- Kategori Produk Widget -->
    @if(isset($productCategories) && count($productCategories) > 0)
        <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white border-l-4 border-dinas-primary pl-3">Kategori
                Produk
            </h3>
            <ul class="space-y-2">
                @foreach($productCategories as $cat)
                    <li>
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                            class="flex items-center justify-between group p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <span
                                class="text-gray-700 dark:text-gray-300 font-medium group-hover:text-dinas-primary transition-colors">{{ $cat->name }}</span>
                            <span
                                class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-300 group-hover:bg-blue-100 group-hover:text-blue-800 transition-colors">
                                {{ $cat->products_count }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Popular Products Widget -->
    @if(isset($popularProducts) && $popularProducts->count() > 0)
        <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h3 class="mb-5 text-lg font-bold text-gray-900 dark:text-white border-l-4 border-dinas-primary pl-3">
                Produk Populer
            </h3>
            <div class="space-y-5">
                @foreach($popularProducts as $popItem)
                    <div class="flex gap-4 group">
                        <a href="{{ route('products.show', $popItem->slug) }}"
                            class="shrink-0 overflow-hidden rounded-lg h-20 w-20 relative border border-gray-100 dark:border-gray-700">
                            <img src="{{ asset('assets/' . $popItem->image) }}"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                alt="{{ $popItem->name }}">
                        </a>
                        <div class="flex flex-col justify-center">
                            <h4
                                class="text-sm font-bold text-gray-900 dark:text-white leading-snug line-clamp-2 group-hover:text-dinas-primary transition-colors">
                                <a href="{{ route('products.show', $popItem->slug) }}">{{ $popItem->name }}</a>
                            </h4>
                            <p class="text-xs font-semibold text-dinas-primary mt-1">
                                Rp {{ number_format($popItem->price, 0, ',', '.') }}
                            </p>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                                </svg>
                                {{ $popItem->seller_name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 text-center">
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-dinas-primary hover:underline">
                    Lihat Semua Produk &rarr;
                </a>
            </div>
        </div>
    @endif

    <!-- Berita Terbaru Widget -->
    @if(isset($recentArticles) && count($recentArticles) > 0)
        <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h3 class="mb-5 text-lg font-bold text-gray-900 dark:text-white border-l-4 border-dinas-primary pl-3">Berita
                Terbaru</h3>
            <div class="space-y-5">
                @forelse($recentArticles as $article)
                    <div class="flex gap-4 group">
                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="shrink-0 overflow-hidden rounded-lg h-20 w-20 relative">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                    alt="{{ $article->title }}">
                            @else
                                <div class="h-full w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div class="flex flex-col justify-center">
                            <h4
                                class="text-sm font-bold text-gray-900 dark:text-white leading-snug line-clamp-2 group-hover:text-dinas-primary transition-colors">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $article->published_at ? $article->published_at->format('d M Y') : 'Baru saja' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada berita terbaru.</p>
                @endforelse
            </div>
        </div>
    @endif

    <!-- Kategori Berita Widget (Renamed) -->
    @if(isset($categories) && count($categories) > 0)
        <div class="p-6 bg-white rounded-2xl border border-gray-100 shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white border-l-4 border-dinas-primary pl-3">Kategori
                Berita
            </h3>
            <ul class="space-y-2">
                @forelse($categories as $category)
                    <li>
                        <a href="{{ route('articles.category', $category->slug) }}"
                            class="flex items-center justify-between group p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <span
                                class="text-gray-700 dark:text-gray-300 font-medium group-hover:text-dinas-primary transition-colors">{{ $category->name }}</span>
                            <span
                                class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-300 group-hover:bg-blue-100 group-hover:text-blue-800 transition-colors">
                                {{ $category->articles_count }}
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">Belum ada kategori.</li>
                @endforelse
            </ul>
        </div>
    @endif

</div>
<x-public-layout>
    <div class="relative bg-gray-50 dark:bg-gray-900 pt-32 pb-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Content (8 cols) -->
                <main class="lg:col-span-8">
                    <!-- Page Header -->
                    <div class="mb-8 text-center lg:text-left">
                        <!-- Breadcrumb -->
                        <div class="flex items-center justify-center lg:justify-start text-sm text-gray-500 font-medium mb-4">
                            <a href="{{ route('welcome') }}" class="hover:text-dinas-primary transition-colors">Beranda</a>
                            <span class="mx-2 text-gray-400">/</span>
                            <span class="text-dinas-primary">Berita & Artikel</span>
                        </div>

                        <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                            Berita & Artikel
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400">
                            Temukan informasi terbaru dan wawasan mendalam dari tim kami.
                        </p>
                    </div>

                    <!-- Featured Articles -->
                    @if($featuredArticles->count() > 0)
                        <section class="mb-12">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                Artikel Unggulan
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($featuredArticles as $article)
                                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow border border-gray-100 dark:bg-gray-800 dark:border-gray-700 flex flex-col h-full">
                                        <a href="{{ route('articles.show', $article->slug) }}" class="block shrink-0 h-48 overflow-hidden relative group">
                                            @if($article->featured_image)
                                                <img src="{{ asset('assets/' . $article->featured_image) }}"
                                                    alt="{{ $article->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                            @if($article->category)
                                                <span class="absolute top-2 right-2 bg-dinas-primary text-white text-xs font-bold px-2 py-1 rounded">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                        </a>
                                        <div class="p-5 flex-grow flex flex-col">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                                <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-dinas-primary transition-colors">
                                                    {{ $article->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3 flex-grow">
                                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                                            </p>
                                            <div class="mt-auto flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                {{ $article->published_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Categories Pill List -->
                    @if($categories->count() > 0)
                        <section class="mb-10">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Jelajahi Kategori</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($categories as $category)
                                    @if($category->published_articles_count > 0)
                                        <a href="{{ route('articles.category', $category->slug) }}" class="inline-flex items-center px-4 py-2 rounded-full border border-gray-200 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-dinas-primary hover:text-dinas-primary transition-colors dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                                            {{ $category->name }}
                                            <span class="ml-2 bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs font-semibold dark:bg-gray-700 dark:text-gray-400">
                                                {{ $category->published_articles_count }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- All Articles List -->
                    <section class="space-y-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Semua Artikel</h2>
                            
                            <!-- Search Form (Desktop) -->
                            <form action="{{ route('articles.search') }}" method="GET" class="hidden md:block relative w-64">
                                <input type="text" name="q" placeholder="Cari artikel..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-dinas-primary focus:border-transparent dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                            </form>
                        </div>
                        
                        @forelse($articles as $article)
                            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row h-full md:h-52">
                                <!-- Image -->
                                <div class="md:w-1/3 shrink-0 relative overflow-hidden h-48 md:h-auto group">
                                    <a href="{{ route('articles.show', $article->slug) }}" class="block w-full h-full">
                                        @if($article->featured_image)
                                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                <!-- Content -->
                                <div class="p-6 md:w-2/3 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2 space-x-2">
                                            @if($article->category)
                                                <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full dark:bg-blue-900/30 dark:text-blue-300 font-medium">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                            <span>{{ $article->published_at->format('d M Y') }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 hover:text-dinas-primary transition-colors">
                                            <a href="{{ route('articles.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2 mb-4">
                                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between mt-auto">
                                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-medium mr-2">Oleh:</span>
                                            {{ $article->author->name }}
                                        </div>
                                        <a href="{{ route('articles.show', $article->slug) }}" class="text-dinas-primary font-medium text-sm hover:underline inline-flex items-center">
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="text-center py-12">
                                <div class="bg-gray-100 dark:bg-gray-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Belum ada artikel</h3>
                                <p class="text-gray-500 dark:text-gray-400">Kami sedang menyiapkan konten menarik untuk Anda.</p>
                            </div>
                        @endforelse

                        <!-- Pagination -->
                        @if($articles->hasPages())
                            <div class="mt-12">
                                {{ $articles->links() }}
                            </div>
                        @endif
                    </section>
                </main>

                <!-- Sidebar (4 cols) -->
                <aside class="lg:col-span-4">
                    <x-public-sidebar />
                </aside>
            </div>
        </div>
    </div>
</x-public-layout>
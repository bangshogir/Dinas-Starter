<x-public-layout>
    <div class="relative bg-gray-50 dark:bg-gray-900 pt-32 pb-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Content (8 cols) -->
                <main class="lg:col-span-8">
                    <!-- Page Header -->
                    <div class="mb-8">
                        <!-- Breadcrumb -->
                        <div class="flex items-center text-sm text-gray-500 font-medium mb-4">
                            <a href="{{ route('welcome') }}"
                                class="hover:text-dinas-primary transition-colors">Beranda</a>
                            <span class="mx-2 text-gray-400">/</span>
                            <a href="{{ route('articles.index') }}"
                                class="hover:text-dinas-primary transition-colors">Artikel</a>
                            <span class="mx-2 text-gray-400">/</span>
                            <span class="text-dinas-primary">Kategori: {{ $category->name }}</span>
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                            {{ $category->name }}
                        </h1>
                        @if($category->description)
                            <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                                {{ $category->description }}
                            </p>
                        @endif

                        <!-- Stats -->
                        <div class="flex flex-wrap gap-4 mb-8">
                            <div
                                class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700 flex items-center">
                                <span
                                    class="bg-blue-100 text-blue-600 p-1.5 rounded-full mr-3 dark:bg-blue-900 dark:text-blue-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                </span>
                                <div>
                                    <span class="block text-xs text-gray-500 uppercase font-semibold">Total
                                        Artikel</span>
                                    <span
                                        class="block text-lg font-bold text-gray-900 dark:text-white leading-none">{{ $category->publishedArticles->count() }}</span>
                                </div>
                            </div>
                            @if($category->children->count() > 0)
                                <div
                                    class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700 flex items-center">
                                    <span
                                        class="bg-purple-100 text-purple-600 p-1.5 rounded-full mr-3 dark:bg-purple-900 dark:text-purple-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                    </span>
                                    <div>
                                        <span
                                            class="block text-xs text-gray-500 uppercase font-semibold">Sub-Kategori</span>
                                        <span
                                            class="block text-lg font-bold text-gray-900 dark:text-white leading-none">{{ $category->children->count() }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sub Categories -->
                    @if($category->children->count() > 0)
                        <section class="mb-10">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Sub-Kategori</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($category->children as $child)
                                    @if($child->publishedArticles->count() > 0)
                                        <a href="{{ route('articles.category', $child->slug) }}"
                                            class="flex items-center justify-between p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-dinas-primary transition-all dark:bg-gray-800 dark:border-gray-700 dark:hover:border-dinas-primary">
                                            <span class="font-medium text-gray-900 dark:text-white">{{ $child->name }}</span>
                                            <span
                                                class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                                {{ $child->publishedArticles->count() }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Articles List -->
                    <section class="space-y-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Artikel Terbaru</h2>
                        </div>

                        @forelse($articles as $article)
                            <article
                                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row h-full md:h-52">
                                <!-- Image -->
                                <div class="md:w-1/3 shrink-0 relative overflow-hidden h-48 md:h-auto group">
                                    <a href="{{ route('articles.show', $article->slug) }}" class="block w-full h-full">
                                        @if($article->featured_image)
                                            <img src="{{ asset('assets/' . $article->featured_image) }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <div
                                                class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                <!-- Content -->
                                <div class="p-6 md:w-2/3 flex flex-col justify-between">
                                    <div>
                                        <div
                                            class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2 space-x-2">
                                            <span
                                                class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full dark:bg-blue-900/30 dark:text-blue-300 font-medium">
                                                {{ $category->name }}
                                            </span>
                                            <span>{{ $article->published_at->format('d M Y') }}</span>
                                        </div>
                                        <h3
                                            class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 hover:text-dinas-primary transition-colors">
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
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                            class="text-dinas-primary font-medium text-sm hover:underline inline-flex items-center">
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="text-center py-12">
                                <div
                                    class="bg-gray-100 dark:bg-gray-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Belum ada artikel</h3>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada artikel untuk kategori ini.</p>
                                <a href="{{ route('articles.index') }}"
                                    class="inline-flex items-center justify-center mt-4 px-6 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-dinas-primary hover:bg-blue-800 transition-colors">
                                    Lihat Semua Artikel
                                </a>
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
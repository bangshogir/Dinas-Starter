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
                            <span class="text-dinas-primary">Pencarian</span>
                        </div>
                        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                            Pencarian: "<span class="text-dinas-primary">{{ $query }}</span>"
                        </h1>
                        <p class="text-gray-500 dark:text-gray-400">
                            Menemukan {{ $articles->total() }} artikel untuk kata kunci tersebut.
                        </p>
                    </div>

                    <!-- Search Fields (Mobile Only - Optional if Sidebar is hidden on mobile) -->
                    <div class="lg:hidden mb-8">
                        <form action="{{ route('articles.search') }}" method="GET" class="relative">
                            <input type="search" name="q" value="{{ $query }}"
                                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-dinas-primary focus:border-dinas-primary dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Cari artikel lain...">
                            <button type="submit"
                                class="absolute right-2.5 bottom-2.5 bg-dinas-primary text-white font-medium rounded-lg text-sm px-4 py-2 hover:bg-blue-800 transition-colors">
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Articles List -->
                    <div class="space-y-6">
                        @forelse($articles as $article)
                            <article
                                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow border border-gray-100 dark:bg-gray-800 dark:border-gray-700 flex flex-col md:flex-row h-full md:h-52">
                                <!-- Image -->
                                <div class="md:w-1/3 shrink-0 relative overflow-hidden h-48 md:h-auto">
                                    <a href="{{ route('articles.show', $article->slug) }}" class="block w-full h-full">
                                        @if($article->featured_image)
                                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
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
                                            @if($article->category)
                                                <span
                                                    class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full dark:bg-blue-900/30 dark:text-blue-300 font-medium">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                            <span>{{ $article->published_at->format('d M Y') }}</span>
                                        </div>
                                        <h2
                                            class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 hover:text-dinas-primary transition-colors">
                                            <a href="{{ route('articles.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h2>
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
                            <div
                                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center dark:bg-gray-800 dark:border-gray-700">
                                <div
                                    class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6 dark:bg-gray-700">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Tidak ditemukan</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
                                    Maaf, kami tidak dapat menemukan artikel yang cocok dengan kata kunci
                                    "<strong>{{ $query }}</strong>". Coba gunakan kata kunci lain.
                                </p>
                                <a href="{{ route('articles.index') }}"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-dinas-primary hover:bg-blue-800 transition-colors">
                                    Lihat Semua Artikel
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($articles->hasPages())
                        <div class="mt-12">
                            {{ $articles->links() }}
                        </div>
                    @endif
                </main>

                <!-- Sidebar (4 cols) -->
                <aside class="lg:col-span-4">
                    <x-public-sidebar />
                </aside>
            </div>
        </div>
    </div>
</x-public-layout>
<x-public-layout>
    <div class="relative bg-gray-50 dark:bg-gray-900 pt-32 pb-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Content (8 cols) -->
                <main class="lg:col-span-8">
                    <!-- Breadcrumb -->
                    <div class="flex items-center text-sm text-gray-500 font-medium mb-6">
                        <a href="{{ route('welcome') }}" class="hover:text-dinas-primary transition-colors">Beranda</a>
                        <span class="mx-2 text-gray-400">/</span>
                        <a href="{{ route('articles.index') }}"
                            class="hover:text-dinas-primary transition-colors">Artikel</a>
                        <span class="mx-2 text-gray-400">/</span>
                        <span class="text-dinas-primary truncate max-w-[150px] md:max-w-xs">{{ $article->title }}</span>
                    </div>

                    <!-- Article Container -->
                    <article
                        class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                        <!-- Featured Image -->
                        @if($article->featured_image)
                            <div class="relative h-[400px] w-full overflow-hidden">
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                                    class="h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-6 left-6 right-6">
                                    <h1 class="text-3xl lg:text-4xl font-extrabold text-white leading-tight mb-2">
                                        {{ $article->title }}
                                    </h1>
                                    <div class="flex items-center text-sm text-gray-200 space-x-4">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            {{ $article->author->name }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ $article->published_at->format('d M Y') }}
                                        </span>
                                        @if($article->category)
                                            <a href="{{ route('articles.category', $article->category->slug) }}"
                                                class="flex items-center hover:text-dinas-primary transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                    </path>
                                                </svg>
                                                {{ $article->category->name }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-8 border-b border-gray-100 dark:border-gray-700">
                                <h1
                                    class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight mb-4">
                                    {{ $article->title }}
                                </h1>
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 space-x-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        {{ $article->author->name }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $article->published_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Content Body -->
                        <div class="p-8 lg:p-12">
                            <!-- Share Buttons -->
                            <div class="flex items-center justify-end mb-8 space-x-2">
                                <span class="text-sm font-medium text-gray-500 mr-2">Bagikan:</span>
                                <button onclick="shareOnFacebook()"
                                    class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </button>
                                <button onclick="shareOnTwitter()"
                                    class="p-2 rounded-full bg-sky-100 text-sky-500 hover:bg-sky-200 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </button>
                                <button onclick="shareOnWhatsApp()"
                                    class="p-2 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                </button>
                                <button onclick="copyArticleUrl()"
                                    class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Typography Content -->
                            <div
                                class="prose prose-lg dark:prose-invert max-w-none prose-a:text-dinas-primary hover:prose-a:text-blue-800 prose-img:rounded-xl">
                                {!! $article->content !!}
                            </div>
                        </div>
                    </article>

                    <!-- Related Articles -->
                    @if($relatedArticles->count() > 0)
                        <div class="mt-12">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Artikel Terkait</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($relatedArticles as $relatedArticle)
                                    <div
                                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                                        <a href="{{ route('articles.show', $relatedArticle) }}"
                                            class="block text-inherit no-underline">
                                            @if($relatedArticle->featured_image)
                                                <div class="h-48 overflow-hidden">
                                                    <img src="{{ asset('storage/' . $relatedArticle->featured_image) }}"
                                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                                        alt="{{ $relatedArticle->title }}">
                                                </div>
                                            @endif
                                            <div class="p-5">
                                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                                    {{ $relatedArticle->title }}
                                                </h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $relatedArticle->published_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
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

    <!-- Scripts -->
    <script>
        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${title}`, '_blank');
        }

        function shareOnTwitter() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            window.open(`https://twitter.com/intent/tweet?text=${title}&url=${url}`, '_blank');
        }

        function shareOnWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            window.open(`https://wa.me/?text=${title}%20${url}`, '_blank');
        }

        function copyArticleUrl() {
            navigator.clipboard.writeText(window.location.href).then(function () {
                alert('Tautan artikel berhasil disalin!');
            });
        }
    </script>
</x-public-layout>
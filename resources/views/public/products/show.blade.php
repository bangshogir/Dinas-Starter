<x-public-layout>
    <div class="relative bg-gray-50 dark:bg-gray-900 pt-32 pb-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Content (8 cols) -->
                <main class="lg:col-span-8">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center text-sm text-gray-500 font-medium mb-6">
                        <a href="{{ url('/') }}" class="hover:text-dinas-primary transition-colors">Beranda</a>
                        <span class="mx-2 text-gray-400">/</span>
                        <a href="{{ route('products.index') }}"
                            class="hover:text-dinas-primary transition-colors">Produk</a>
                        <span class="mx-2 text-gray-400">/</span>
                        <span class="text-dinas-primary truncate max-w-[150px] md:max-w-xs">{{ $product->name }}</span>
                    </nav>

                    <!-- Product Container -->
                    <div
                        class="bg-white rounded-2xl shadow-lg run-flow-hidden border border-gray-100 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                        <!-- Product Image -->
                        <div class="relative h-[400px] w-full bg-gray-100 dark:bg-gray-700">
                            <img src="{{ asset('assets/' . $product->image) }}" alt="{{ $product->name }}"
                                class="h-full w-full object-cover">
                        </div>

                        <div class="p-8 lg:p-10">
                            <!-- Seller & Category Badge -->
                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300 uppercase tracking-wide">
                                    <i class="fa-solid fa-store mr-1.5"></i> {{ $product->seller_name }}
                                </span>
                                @if($product->category)
                                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                                        class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full dark:bg-amber-900 dark:text-amber-300 uppercase tracking-wide hover:bg-amber-200 transition-colors">
                                        {{ $product->category->name }}
                                    </a>
                                @endif
                            </div>

                            <h1
                                class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight mb-4">
                                {{ $product->name }}
                            </h1>

                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8 pb-8 border-b border-gray-100 dark:border-gray-700">
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Harga
                                        Produk</span>
                                    <span class="text-3xl font-bold text-dinas-primary">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                <a href="https://wa.me/{{ $product->seller_phone }}?text={{ urlencode('Halo ' . $product->seller_name . ', saya tertarik dengan produk ' . $product->name . ' yang ada di website Dinas.') }}"
                                    target="_blank"
                                    class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white font-bold py-3.5 px-8 rounded-full transition-all shadow-lg hover:shadow-green-500/30 transform hover:-translate-y-1 group">
                                    <i
                                        class="fa-brands fa-whatsapp text-2xl group-hover:scale-110 transition-transform"></i>
                                    <span>Beli via WhatsApp</span>
                                </a>
                            </div>

                            <div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Deskripsi Produk</h3>
                                <p class="whitespace-pre-line leading-relaxed">
                                    {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Sidebar (4 cols) -->
                <aside class="lg:col-span-4 space-y-8">
                    <!-- Standard Public Sidebar with Popular Products & Categories -->
                    <x-public-sidebar :popularProducts="$popularProducts" :productCategories="$productCategories ?? []"
                        :categories="\App\Models\ArticleCategory::withCount('articles')->get()"
                        :recentArticles="\App\Models\Article::latest()->take(3)->get()" />
                </aside>
            </div>
        </div>
    </div>
</x-public-layout>
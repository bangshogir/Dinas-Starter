<x-public-layout>
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-20">
        <div class="max-w-screen-xl mx-auto px-4 lg:px-6">
            <!-- Header -->
            <div class="text-center mb-12">
                <span class="text-dinas-primary font-bold tracking-wider uppercase text-sm">Etalase UMKM</span>
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mt-2 mb-4">Produk Unggulan Daerah</h1>
                <p class="text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
                    Temukan berbagai produk berkualitas dari UMKM lokal kami. Dukung ekonomi daerah dengan membeli
                    produk lokal.
                </p>
            </div>

            <!-- Search -->
            <div class="max-w-2xl mx-auto mb-12">
                <form action="{{ route('products.index') }}" method="GET" class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="search" name="q" value="{{ request('q') }}"
                        class="block w-full p-4 pl-12 text-gray-900 border border-gray-200 rounded-full bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white shadow-lg"
                        placeholder="Cari produk atau nama toko...">
                    <button type="submit"
                        class="absolute right-2.5 bottom-2.5 bg-dinas-primary hover:bg-blue-700 text-white font-medium rounded-full text-sm px-6 py-2 transition-colors">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($products as $product)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 group border border-gray-100 dark:border-gray-700 flex flex-col h-full transform hover:-translate-y-1">
                        <!-- Image Container -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('assets/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

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
                    <div class="col-span-full text-center py-12">
                        <div
                            class="mb-4 inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Produk tidak ditemukan</h3>
                        <p class="text-gray-500 dark:text-gray-400">Silakan coba kata kunci lain atau kembali lagi nanti.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-public-layout>
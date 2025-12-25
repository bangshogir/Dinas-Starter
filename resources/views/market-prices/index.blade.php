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
                            <span class="text-dinas-primary">Harga Pasar</span>
                        </div>

                        <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                            Info Harga Pasar
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400">
                            Pantau perkembangan harga komoditas pangan strategis di pasar tradisional daerah kami.
                            Data diperbarui secara berkala.
                        </p>
                    </div>

                    <!-- Date/Filter Info (Optional Placeholder) -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-dinas-primary p-4 mb-8 rounded-r-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-dinas-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700 dark:text-blue-200">
                                    Data terakhir diperbarui:
                                    <span class="font-bold">
                                        {{ $marketPrices->max('updated_at')?->format('d M Y') ?? 'Belum ada data' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Prices Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($marketPrices as $price)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md border border-gray-100 dark:border-gray-700 flex items-center justify-between hover:shadow-lg transition-shadow">
                                <div class="flex items-center space-x-4">
                                    <!-- Icon based on commodity name (optional, simple placeholder for now) -->
                                    <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-full shrink-0">
                                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $price->commodity_name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">per {{ $price->unit }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">
                                        Rp {{ number_format($price->price, 0, ',', '.') }}
                                    </p>
                                    <div class="flex items-center justify-end mt-1">
                                        @if ($price->trend_status == 'naik')
                                            <span
                                                class="text-xs font-medium text-red-600 bg-red-100 dark:bg-red-900/30 dark:text-red-400 px-2 py-0.5 rounded-full flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                </svg>
                                                {{ $price->trend_percentage }}%
                                            </span>
                                        @elseif($price->trend_status == 'turun')
                                            <span
                                                class="text-xs font-medium text-green-600 bg-green-100 dark:bg-green-900/30 dark:text-green-400 px-2 py-0.5 rounded-full flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                </svg>
                                                {{ $price->trend_percentage }}%
                                            </span>
                                        @else
                                            <span
                                                class="text-xs font-medium text-blue-600 bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 px-2 py-0.5 rounded-full flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                </svg>
                                                Stabil
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <div
                                    class="bg-gray-100 dark:bg-gray-700 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tidak ada data harga</h3>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada informasi harga pasar yang tersedia
                                    saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </main>

                <!-- Sidebar (4 cols) -->
                <aside class="lg:col-span-4">
                    <x-public-sidebar />
                </aside>
            </div>
        </div>
    </div>
</x-public-layout>
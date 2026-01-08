@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 space-y-6 xl:col-span-7">
            <!-- Metric Group One -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6">
                <!-- Metric Item: Total Artikel -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-50 dark:bg-brand-500/15">
                        <i class="fa-solid fa-newspaper text-xl text-brand-500"></i>
                    </div>

                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Total Artikel</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                {{ number_format($stats['total_articles']) }}
                            </h4>
                        </div>
                        <a href="{{ route('admin.articles.index') }}"
                            class="flex items-center gap-1 rounded-full bg-brand-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-brand-600 hover:bg-brand-100 dark:bg-brand-500/15 dark:text-brand-400 dark:hover:bg-brand-500/25">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            Lihat
                        </a>
                    </div>
                </div>
                <!-- Metric Item End -->

                <!-- Metric Item: Total Produk -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-success-50 dark:bg-success-500/15">
                        <i class="fa-solid fa-store text-xl text-success-500"></i>
                    </div>

                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Total Produk</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                {{ number_format($stats['total_products']) }}
                            </h4>
                        </div>
                        <a href="{{ route('admin.products.index') }}"
                            class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-success-600 hover:bg-success-100 dark:bg-success-500/15 dark:text-success-400 dark:hover:bg-success-500/25">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                            Lihat
                        </a>
                    </div>
                </div>
                <!-- Metric Item End -->
            </div>
            <!-- Metric Group One -->

            <!-- ====== Chart One Start -->
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Pengunjung Website ({{ date('Y') }})
                    </h3>
                    <div x-data="{openDropDown: false}" class="relative h-fit">
                        <button @click="openDropDown = !openDropDown"
                            :class="openDropDown ? 'text-gray-700 dark:text-white' : 'text-gray-400 hover:text-gray-700 dark:hover:text-white'">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z"
                                    fill="" />
                            </svg>
                        </button>
                        <div x-show="openDropDown" @click.outside="openDropDown = false"
                            class="absolute right-0 z-40 w-40 p-2 space-y-1 bg-white border border-gray-200 top-full rounded-2xl shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark">
                            <button
                                class="flex w-full px-3 py-2 font-medium text-left text-gray-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                View More
                            </button>
                            <button
                                class="flex w-full px-3 py-2 font-medium text-left text-gray-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class="max-w-full overflow-x-auto custom-scrollbar">
                    <div class="-ml-5 min-w-[650px] pl-2 xl:min-w-full">
                        <div id="chartOne" class="-ml-5 h-[310px] min-w-[650px] pl-2 xl:min-w-full"
                            data-series="{{ json_encode($visitorCounts) }}"></div>
                    </div>
                </div>
            </div>
            <!-- ====== Chart One End -->
        </div>

        <div class="col-span-12 xl:col-span-5">
            <!-- ====== Chart Two Start -->
            <!-- ====== Market Prices Start -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
                <div class="mb-4 flex justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Harga Pasar Terbaru
                        </h3>
                        <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                            Update harga komoditas terkini
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    @forelse($recentMarketPrices as $price)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-50 text-brand-500 dark:bg-brand-500/15 dark:text-brand-400">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-800 dark:text-white/90">
                                        {{ $price->commodity_name ?? 'Unknown Commodity' }}
                                    </h5>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $price->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-800 dark:text-white/90">
                                    Rp {{ number_format($price->price, 0, ',', '.') }}
                                </p>
                                <div class="flex items-center justify-end gap-1 mt-0.5">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        / {{ $price->unit ?? 'Kg' }}
                                    </span>
                                    @if($price->trend_status == 'naik')
                                        <span class="flex items-center gap-0.5 text-xs font-medium text-error-500">
                                            <i class="fa-solid fa-arrow-up"></i>
                                            {{ $price->trend_percentage }}%
                                        </span>
                                    @elseif($price->trend_status == 'turun')
                                        <span class="flex items-center gap-0.5 text-xs font-medium text-success-500">
                                            <i class="fa-solid fa-arrow-down"></i>
                                            {{ $price->trend_percentage }}%
                                        </span>
                                    @else
                                        <span class="flex items-center gap-0.5 text-xs font-medium text-gray-400">
                                            <i class="fa-solid fa-minus"></i>
                                            Stabil
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada data harga pasar</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 border-t border-gray-100 pt-4 dark:border-gray-800">
                    <a href="{{ route('admin.market-prices.index') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:bg-white/[0.03] dark:text-gray-400 dark:hover:bg-white/[0.05]">
                        Lihat Semua Harga
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            <!-- ====== Market Prices End -->
            <!-- ====== Chart Two End -->
        </div>

        <div class="col-span-12">
            <div class="col-span-12">
                <!-- Chart Three Removed -->
            </div>
        </div>

        <div class="col-span-12 xl:col-span-5">
            <!-- ====== Articles List Start -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
                <div class="mb-4 flex justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Artikel Terbaru
                        </h3>
                        <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                            Postingan artikel terkini
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    @forelse($recentArticles as $article)
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800">
                                @if($article->featured_image)
                                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                                        class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-gray-400">
                                        <i class="fa-solid fa-newspaper text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h5 class="text-sm font-medium text-gray-800 dark:text-white/90 line-clamp-1">
                                    {{ $article->title }}
                                </h5>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $article->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div>
                                <span
                                    class="inline-flex rounded-full bg-brand-50 px-2.5 py-0.5 text-xs font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                    {{ $article->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada artikel</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 border-t border-gray-100 pt-4 dark:border-gray-800">
                    <a href="{{ route('admin.articles.index') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:bg-white/[0.03] dark:text-gray-400 dark:hover:bg-white/[0.05]">
                        Lihat Semua Artikel
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            <!-- ====== Articles List End -->


        </div>

        <div class="col-span-12 xl:col-span-7">
            <!-- ====== Table One Start -->
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
                <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Produk Terbaru
                        </h3>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.products.create') }}"
                            class="inline-flex items-center gap-2 rounded-lg border border-brand-500 bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                            <i class="fa-solid fa-plus"></i>
                            Tambah
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-gray-100 border-y dark:border-gray-800">
                                <th class="py-3 text-left">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Produk
                                    </p>
                                </th>
                                <th class="py-3 text-left">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Kategori
                                    </p>
                                </th>
                                <th class="py-3 text-left">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Harga
                                    </p>
                                </th>
                                <th class="py-3 text-left">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Tanggal
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($recentProducts as $product)
                                <tr>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="h-[50px] w-[50px] overflow-hidden rounded-md bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                                    @if($product->image)
                                                        <img src="{{ asset('assets/' . $product->image) }}"
                                                            alt="{{ $product->name }}" class="h-full w-full object-cover" />
                                                    @else
                                                        <i class="fa-solid fa-box text-gray-400 text-xl"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-800 text-theme-sm dark:text-white/90 line-clamp-1">
                                                        {{ $product->name }}
                                                    </p>
                                                    <span class="text-gray-500 text-theme-xs dark:text-gray-400">
                                                        {{ $product->seller ?? 'UMKM' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            @if($product->category)
                                                <span
                                                    class="inline-flex rounded-full bg-brand-50 px-2 py-0.5 text-theme-xs font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                                    {{ $product->category->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-theme-sm dark:text-gray-500">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                {{ $product->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <i class="fa-solid fa-store text-3xl text-gray-300 dark:text-gray-600"></i>
                                            <p class="text-gray-500 dark:text-gray-400">Belum ada produk</p>
                                            <a href="{{ route('admin.products.create') }}"
                                                class="mt-2 inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                                                <i class="fa-solid fa-plus"></i>
                                                Tambah Produk Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Table One End -->
        </div>
    </div>
@endsection
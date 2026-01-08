@extends('layouts.admin')

@section('title', 'Katalog Produk UMKM')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Katalog Produk UMKM
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium text-gray-600 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li class="font-medium text-brand-500">Produk</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.products.create') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
            <i class="fa-solid fa-plus w-5 h-5"></i>
            Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-success-50 px-6 py-4 text-success-800 dark:bg-success-500/15 dark:text-success-500">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-check-circle"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Table Container -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <!-- Header with Search -->
        <div
            class="flex flex-col gap-4 px-5 py-4 sm:px-6 sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 dark:border-gray-800">
            <!-- Title -->
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Daftar Produk
            </h3>

            <!-- Search -->
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="w-full sm:w-64 rounded-lg border border-gray-300 bg-transparent pl-12 pr-5 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />

                    <!-- Search Icon -->
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                </div>
            </form>
        </div>

        <div class="max-w-full overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Produk</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kategori</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Harga</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Penjual</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($products as $product)
                        <tr>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-12 w-12 overflow-hidden rounded-md border border-gray-200 dark:border-gray-700">
                                        <img src="{{ asset('assets/' . $product->image) }}" class="h-full w-full object-cover"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div>
                                        <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                            {{ $product->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @if($product->category)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-brand-50 px-2.5 py-0.5 text-theme-xs font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                        {{ $product->category->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400 dark:text-gray-500 text-theme-xs">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div>
                                    <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $product->seller_name }}
                                    </span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">
                                        {{ $product->seller_phone }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @if($product->is_active)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-success-600 dark:bg-success-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-gray-50 px-2 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-600 dark:bg-gray-500"></span>
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center space-x-3.5">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="text-gray-500 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors">
                                        <i class="fa-regular fa-pen-to-square w-5 h-5 text-current"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-gray-500 hover:text-error-500 dark:text-gray-400 dark:hover:text-error-400 transition-colors">
                                            <i class="fa-regular fa-trash-can w-5 h-5 text-current"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                                        <i class="fa-solid fa-box-open w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <h3 class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90">Belum ada produk
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Silakan tambahkan produk UMKM pertama
                                        Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
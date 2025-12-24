@extends('layouts.admin')

@section('title', 'Harga Pasar')

@section('content')
    <!-- Header -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Harga Pasar
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li class="font-medium text-primary">Harga Pasar</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.market-prices.create') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 sm:w-auto">
            <i class="fa-solid fa-plus w-5 h-5"></i>
            Tambah Data
        </a>
    </div>

    @include('partials.admin.notifications')

    <!-- Table Container -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div
            class="flex flex-col gap-4 px-5 py-4 sm:px-6 sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 dark:border-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Daftar Harga Komoditas
            </h3>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.market-prices.index') }}" class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Komoditas..."
                        class="w-full sm:w-64 rounded-lg border border-gray-300 bg-transparent pl-12 pr-5 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
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
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Komoditas</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Harga</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Satuan</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tren</p>
                        </th>
                        <th class="px-5 py-3 sm:px-6 text-left">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($prices as $price)
                        <tr>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    {{ $price->commodity_name }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    Rp {{ number_format($price->price, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $price->unit }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @if($price->trend_status == 'naik')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-700 dark:bg-error-500/15 dark:text-error-500">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        Naik {{ $price->trend_percentage }}%
                                    </span>
                                @elseif($price->trend_status == 'turun')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                        </svg>
                                        Turun {{ $price->trend_percentage }}%
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-gray-50 px-2 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-500">
                                        Stabil
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center space-x-3.5">
                                    <a href="{{ route('admin.market-prices.edit', $price) }}"
                                        class="text-gray-500 hover:text-primary dark:text-gray-400 dark:hover:text-primary transition-colors"
                                        title="Update Harga">
                                        <i class="fa-regular fa-pen-to-square w-5 h-5 text-current"></i>
                                    </a>
                                    <form action="{{ route('admin.market-prices.destroy', $price) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus komoditas {{ $price->commodity_name }}? Data tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-gray-500 hover:text-error-500 dark:text-gray-400 dark:hover:text-error-400 transition-colors"
                                            title="Hapus Data">
                                            <i class="fa-regular fa-trash-can w-5 h-5 text-current"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                                        <i class="fa-regular fa-file-lines w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <h3 class="mb-1 text-lg font-semibold text-gray-800 dark:text-white/90">Data tidak ditemukan
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        @if(request('search'))
                                            Tidak ada komoditas dengan nama "{{ request('search') }}"
                                        @else
                                            Belum ada data harga pasar.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-5 py-4 sm:px-6 border-t border-gray-100 dark:border-gray-800">
            {{ $prices->links() }}
        </div>
    </div>
@endsection
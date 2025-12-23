@extends('layouts.admin')

@section('title', 'Update Harga Komoditas')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Update Harga
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium" href="{{ route('admin.market-prices.index') }}">Harga Pasar /</a></li>
                    <li class="font-medium text-primary">Update</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.market-prices.index') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            <x-heroicon-o-arrow-left class="w-5 h-5" />
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.market-prices.update', $marketPrice) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-9 lg:grid-cols-2">
            <!-- Left Column -->
            <div class="flex flex-col gap-9">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">
                        {{ $marketPrice->commodity_name }} / {{ $marketPrice->unit }}
                    </h3>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Harga Terakhir
                        </label>
                        <input type="text" value="Rp {{ number_format($marketPrice->price, 0, ',', '.') }}" disabled
                            class="cursor-not-allowed opacity-60 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Harga Baru (Rp) <span class="text-error-500">*</span>
                        </label>
                        <input type="number" name="price" value="{{ old('price', $marketPrice->price) }}" required min="0"
                            step="100"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                            Masukkan angka saja tanpa titik atau koma. Contoh: 15000
                        </p>
                        @error('price')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <x-heroicon-o-check class="w-5 h-5" />
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
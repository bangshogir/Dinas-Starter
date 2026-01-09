@extends('layouts.admin')

@section('title', 'Tambah Harga Komoditas')

@section('content')
    @include('partials.admin.notifications')
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Tambah Data Harga
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium text-gray-600 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium text-gray-600 dark:text-gray-400"
                            href="{{ route('admin.market-prices.index') }}">Harga Pasar /</a></li>
                    <li class="font-medium text-brand-500">Tambah</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.market-prices.index') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            <i class="fa-solid fa-arrow-left w-5 h-5"></i>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.market-prices.store') }}">
        @csrf

        <div class="grid grid-cols-1 gap-9 lg:grid-cols-2">
            <!-- Left Column -->
            <div class="flex flex-col gap-9">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">
                        Informasi Komoditas
                    </h3>

                    <!-- Commodity Name -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Komoditas <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="commodity_name" value="{{ old('commodity_name') }}" required
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Contoh: Beras Premium" />
                        @error('commodity_name')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Harga (Rp) <span class="text-error-500">*</span>
                        </label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0" step="100"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Contoh: 15000" />
                        @error('price')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Satuan <span class="text-error-500">*</span>
                        </label>
                        <select name="unit" required
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 relative z-20 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="">Pilih Satuan</option>
                            <option value="Kg" {{ old('unit') == 'Kg' ? 'selected' : '' }}>Kg</option>
                            <option value="Liter" {{ old('unit') == 'Liter' ? 'selected' : '' }}>Liter</option>
                            <option value="Ikat" {{ old('unit') == 'Ikat' ? 'selected' : '' }}>Ikat</option>
                            <option value="Buah" {{ old('unit') == 'Buah' ? 'selected' : '' }}>Buah</option>
                            <option value="Bungkus" {{ old('unit') == 'Bungkus' ? 'selected' : '' }}>Bungkus</option>
                        </select>
                        @error('unit')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <i class="fa-solid fa-check w-5 h-5"></i>
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
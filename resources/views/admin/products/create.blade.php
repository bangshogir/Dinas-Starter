@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
    @include('partials.admin.notifications')
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Tambah Produk Baru
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium text-gray-600 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium text-gray-600 dark:text-gray-400"
                            href="{{ route('admin.products.index') }}">Produk /</a></li>
                    <li class="font-medium text-brand-500">Tambah</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.products.index') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            <i class="fa-solid fa-arrow-left w-5 h-5"></i>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-9 lg:grid-cols-2">
            <!-- Left Column: Product Image -->
            <div class="flex flex-col gap-9">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Gambar Produk</h3>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kategori Produk
                        </label>
                        <div class="relative">
                            <select name="product_category_id"
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="">-- Pilih Kategori (Opsional) --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 z-10 -translate-y-1/2 pointer-events-none">
                                <i class="fa-solid fa-chevron-down w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                            </span>
                        </div>
                        @error('product_category_id')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Upload Gambar <span class="text-error-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-lg relative hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors"
                            id="drop-area">
                            <div class="space-y-2 text-center">
                                <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                    <label for="image"
                                        class="relative cursor-pointer rounded-md font-medium text-brand-500 hover:text-brand-600 focus-within:outline-none">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only" required accept="image/*"
                                            onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                            <img id="preview"
                                class="hidden absolute inset-0 w-full h-full object-cover rounded-lg opacity-90" />
                        </div>
                        @error('image')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Penjual</h3>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Penjual / Toko <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="seller_name" value="{{ old('seller_name') }}" required
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nomor WhatsApp <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="seller_phone" value="{{ old('seller_phone') }}" required
                            placeholder="Contoh: 08123456789"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                            Nomor akan otomatis dikonversi ke format 62.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="flex flex-col gap-9">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Detail Produk</h3>

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Produk <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Harga (Rp) <span class="text-error-500">*</span>
                        </label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="5"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description') }}</textarea>
                    </div>

                    <!-- Is Active -->
                    <div class="mb-6">
                        <label
                            class="flex cursor-pointer select-none items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-400">
                            <input type="checkbox" name="is_active" value="1" checked class="sr-only peer" />
                            <div
                                class="h-5 w-9 rounded-full bg-gray-200 shadow-inner dark:bg-gray-700 peer-checked:bg-brand-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all relative">
                            </div>
                            Tampilkan Produk Ini
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <a href="{{ route('admin.products.index') }}"
                            class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                            <i class="fa-solid fa-check w-5 h-5"></i>
                            Simpan Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
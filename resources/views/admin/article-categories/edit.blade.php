@extends('layouts.admin')

@section('title', 'Edit Kategori: ' . $articleCategory->name)

@section('content')
    @include('partials.admin.notifications')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Edit Kategori Artikel
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium text-gray-600 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium text-gray-600 dark:text-gray-400"
                            href="{{ route('admin.article-categories.index') }}">Kategori /</a></li>
                    <li class="font-medium text-brand-500">Edit</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.article-categories.index') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            <i class="fa-solid fa-arrow-left w-5 h-5"></i>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.article-categories.update', $articleCategory) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-9 lg:grid-cols-3">
            <!-- Left Column -->
            <div class="flex flex-col gap-9 lg:col-span-2">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Kategori</h3>

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Kategori <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $articleCategory->name) }}" required
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Masukkan nama kategori" />
                        @error('name')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Slug
                        </label>
                        <div class="relative">
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $articleCategory->slug) }}"
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 pr-12 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                placeholder="slug-kategori-otomatis" />
                            <button type="button" onclick="generateSlug()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1.5 text-gray-500 hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 transition-colors"
                                title="Generate slug dari nama kategori">
                                <i class="fa-solid fa-rotate w-5 h-5"></i>
                            </button>
                        </div>
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                            Slug akan otomatis dibuat dari nama kategori. Klik icon untuk regenerate.
                        </p>
                        @error('slug')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="5"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Deskripsi singkat kategori...">{{ old('description', $articleCategory->description) }}</textarea>
                        @error('description')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Parent Category -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kategori Induk
                        </label>
                        <div class="relative z-20 bg-transparent dark:bg-dark-900">
                            <select name="parent_id" id="parent_id"
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 relative z-20 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="">Tidak Ada (Kategori Utama)</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $articleCategory->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2 pointer-events-none">
                                <i class="fa-solid fa-chevron-down w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                            </span>
                        </div>
                        @error('parent_id')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="flex flex-col gap-9 lg:col-span-1">
                <!-- Settings -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Pengaturan</h3>

                    <div class="mb-4">
                        <label
                            class="flex cursor-pointer select-none items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-400">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $articleCategory->is_active) ? 'checked' : '' }} class="sr-only peer" />
                            <div
                                class="h-5 w-9 rounded-full bg-gray-200 shadow-inner dark:bg-gray-700 peer-checked:bg-brand-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all relative">
                            </div>
                            Kategori Aktif
                        </label>
                        @error('is_active')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Urutan
                        </label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $articleCategory->sort_order) }}"
                            min="0" step="1"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="0" />
                        @error('sort_order')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <i class="fa-solid fa-check w-5 h-5"></i>
                        Simpan Perubahan
                    </button>
                </div>

                <!-- SEO Info -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">SEO Info</h3>

                    <div class="mb-4">
                        <label class="mb-2.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Preview URL Publik
                        </label>
                        <div class="relative">
                            <input type="text" id="url_preview" readonly
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            <button type="button" onclick="copyUrl()"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded-md p-1.5 text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-800">
                                <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.6667 1.33333H2.66667C1.93333 1.33333 1.33333 1.93333 1.33333 2.66667V10.6667H2.66667V2.66667H10.6667V1.33333ZM12.6667 4H5.33333C4.6 4 4 4.6 4 5.33333V13.3333C4 14.0667 4.6 14.6667 5.33333 14.6667H12.6667C13.4 14.6667 14 14.0667 14 13.3333V5.33333C14 4.6 13.4 4 12.6667 4ZM12.6667 13.3333H5.33333V5.33333H12.6667V13.3333Z"
                                        fill="" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Full Name Preview
                        </label>
                        <input type="text" id="full_name_preview" readonly
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                </div>

                <!-- Stats -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Statistik</h3>
                    <div class="flex flex-col gap-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Total Artikel</span>
                            <span
                                class="font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->articles->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Publikasi</span>
                            <span
                                class="font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->publishedArticles->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Sub-Kategori</span>
                            <span
                                class="font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->children->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Dibuat</span>
                            <span
                                class="font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->created_at->format('d M Y') }}</span>
                        </div>
                        @if($articleCategory->updated_at != $articleCategory->created_at)
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Diupdate</span>
                                <span
                                    class="font-medium text-gray-800 dark:text-white/90">{{ $articleCategory->updated_at->format('d M Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function generateSlug() {
            const name = document.getElementById('name').value;
            const slugField = document.getElementById('slug');

            if (name) {
                const slug = name.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');

                slugField.value = slug;
                updatePreview();
            }
        }

        function updatePreview() {
            const slug = document.getElementById('slug').value || 'kategori-baru';
            const parentSelect = document.getElementById('parent_id');
            const parentOption = parentSelect.options[parentSelect.selectedIndex];
            const parentName = parentOption && parentSelect.value ? parentOption.text.trim() : '';

            const urlPreview = document.getElementById('url_preview');
            const fullNamePreview = document.getElementById('full_name_preview');

            urlPreview.value = window.location.origin + '/articles/category/' + slug;

            if (parentName) {
                fullNamePreview.value = parentName + ' > ' + (document.getElementById('name').value || 'Nama Kategori');
            } else {
                fullNamePreview.value = document.getElementById('name').value || 'Nama Kategori';
            }
        }

        function copyUrl() {
            const urlPreview = document.getElementById('url_preview');
            navigator.clipboard.writeText(urlPreview.value).then(function () {
                alert('URL berhasil disalin!');
            }, function () {
                // Fallback for older browsers
                urlPreview.select();
                document.execCommand('copy');
                alert('URL berhasil disalin!');
            });
        }

        // Auto-generate slug on name input with debounce
        let slugTimeout;
        document.getElementById('name').addEventListener('input', function () {
            clearTimeout(slugTimeout);
            slugTimeout = setTimeout(function () {
                generateSlug();
            }, 500);
        });

        document.getElementById('slug').addEventListener('input', updatePreview);
        document.getElementById('parent_id').addEventListener('change', updatePreview);

        // Initialize preview
        document.addEventListener('DOMContentLoaded', updatePreview);
    </script>
@endpush
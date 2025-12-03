@extends('layouts.admin')

@section('title', 'Tambah Kategori Artikel')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Tambah Kategori Artikel
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium" href="{{ route('admin.article-categories.index') }}">Kategori /</a></li>
                    <li class="font-medium text-primary">Tambah</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.article-categories.index') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.0203 3.51583C11.1996 3.33653 11.2761 3.0788 11.2238 2.8307C11.1714 2.5826 11.0026 2.37048 10.7601 2.27996C10.5176 2.18944 10.2483 2.23846 10.0518 2.40905L3.42681 8.15905C3.16006 8.39054 3.00003 8.7366 3.00003 9.10006C3.00003 9.46352 3.16006 9.80959 3.42681 10.0411L10.0518 15.7911C10.2483 15.9617 10.5176 16.0107 10.7601 15.9202C11.0026 15.8296 11.1714 15.6175 11.2238 15.3694C11.2761 15.1213 11.1996 14.8636 11.0203 14.6843L5.47163 9.86881L14.25 9.86881C14.6642 9.86881 15 9.53302 15 9.11881C15 8.7046 14.6642 8.36881 14.25 8.36881L5.47163 8.36881L11.0203 3.51583Z"
                    fill="" />
            </svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.article-categories.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-9 lg:grid-cols-3">
            <!-- Left Column -->
            <div class="flex flex-col gap-9 lg:col-span-2">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Informasi Kategori</h3>

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="mb-2.5 block font-medium text-gray-700 dark:text-gray-400">
                            Nama Kategori <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-5 py-3 text-gray-800 outline-none focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            placeholder="Masukkan nama kategori" />
                        @error('name')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label class="mb-2.5 block font-medium text-gray-700 dark:text-gray-400">
                            Slug
                        </label>
                        <div class="relative">
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 px-5 py-3 text-gray-800 outline-none focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                                placeholder="slug-kategori-otomatis" />
                            <button type="button" onclick="generateSlug()"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded-md p-2 text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-800">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.875 10C16.875 13.797 13.797 16.875 10 16.875C6.20304 16.875 3.125 13.797 3.125 10C3.125 6.20304 6.20304 3.125 10 3.125C11.6684 3.125 13.1965 3.71966 14.4042 4.71696L14.8839 5.11304L13.7768 6.45371L13.2971 6.05763C12.3789 5.29944 11.229 4.84375 10 4.84375C7.15228 4.84375 4.84375 7.15228 4.84375 10C4.84375 12.8477 7.15228 15.1562 10 15.1562C12.8477 15.1562 15.1562 12.8477 15.1562 10H16.875ZM15.3125 5.625V1.25H17.0312V7.34375H10.9375V5.625H15.3125Z"
                                        fill="" />
                                </svg>
                            </button>
                        </div>
                        @error('slug')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="mb-2.5 block font-medium text-gray-700 dark:text-gray-400">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="5"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-5 py-3 text-gray-800 outline-none focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            placeholder="Deskripsi singkat kategori...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Parent Category -->
                    <div class="mb-4">
                        <label class="mb-2.5 block font-medium text-gray-700 dark:text-gray-400">
                            Kategori Induk
                        </label>
                        <div class="relative z-20 bg-transparent dark:bg-dark-900">
                            <select name="parent_id" id="parent_id"
                                class="relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-5 py-3 text-gray-800 outline-none focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                                <option value="">Tidak Ada (Kategori Utama)</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.99922 12.8249C8.83047 12.8249 8.68984 12.7687 8.54922 12.6562L2.08047 6.2999C1.82734 6.04678 1.82734 5.65303 2.08047 5.3999C2.33359 5.14678 2.72734 5.14678 2.98047 5.3999L8.99922 11.278L15.018 5.3999C15.2711 5.14678 15.6648 5.14678 15.918 5.3999C16.1711 5.65303 16.1711 6.04678 15.918 6.2999L9.44922 12.6562C9.30859 12.7687 9.16797 12.8249 8.99922 12.8249Z"
                                        fill="" />
                                </svg>
                            </span>
                        </div>
                        @error('parent_id')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
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
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="sr-only peer" />
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
                        <label class="mb-2.5 block font-medium text-gray-700 dark:text-gray-400">
                            Urutan
                        </label>
                        <input type="number" name="sort_order" value="{{ old('sort_order') }}" min="0" step="1"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-5 py-3 text-gray-800 outline-none focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800"
                            placeholder="0" />
                        @error('sort_order')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.7535 2.47502H11.5879V4.9969H13.7535V2.47502ZM4.85773 13.6323H5.50685L12.2166 6.92255L11.5675 6.27345L4.85773 12.9832V13.6323ZM13.3289 0.912537H11.5879H10.2512C9.71618 0.912537 9.28125 1.34747 9.28125 1.8825V3.83376L3.62823 9.48677C3.36197 9.75303 3.2124 10.1141 3.2124 10.4906V14.2344C3.2124 14.7694 3.64734 15.2044 4.18237 15.2044H7.92613C8.30266 15.2044 8.66373 15.0548 8.93 14.7885L14.583 9.13549V11.1019C14.583 11.6369 15.018 12.0719 15.553 12.0719C16.088 12.0719 16.523 11.6369 16.523 11.1019V2.47502C16.523 1.61252 15.823 0.912537 14.9605 0.912537H13.3289Z"
                                fill="" />
                        </svg>
                        Simpan Kategori
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
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function generateSlug() {
            const name = document.getElementById('name').value;
            const slugField = document.getElementById('slug');

            if (name && !slugField.value) {
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
            });
        }

        // Event listeners
        document.getElementById('name').addEventListener('input', function () {
            if (!document.getElementById('slug').value) {
                generateSlug();
            }
            updatePreview();
        });

        document.getElementById('slug').addEventListener('input', updatePreview);
        document.getElementById('parent_id').addEventListener('change', updatePreview);

        // Initialize preview
        document.addEventListener('DOMContentLoaded', updatePreview);
    </script>
@endpush
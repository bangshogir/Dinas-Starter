@extends('layouts.admin')

@section('title', 'Tambah Artikel')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Tambah Artikel
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium" href="{{ route('admin.articles.index') }}">Artikel /</a></li>
                    <li class="font-medium text-primary">Tambah</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.articles.index') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            <i class="fa-solid fa-arrow-left w-5 h-5"></i>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-9 lg:grid-cols-3">
            <!-- Left Column -->
            <div class="flex flex-col gap-9 lg:col-span-2">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Konten Artikel</h3>
                    
                    <!-- Title -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Judul <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Masukkan judul artikel" />
                        @error('title')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Slug
                        </label>
                        <div class="relative">
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 pr-12 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                placeholder="slug-artikel-otomatis" />
                            <button type="button" onclick="generateSlug()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1.5 text-gray-500 hover:bg-gray-200 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 transition-colors"
                                title="Generate slug dari judul">
                                <i class="fa-solid fa-rotate w-5 h-5"></i>
                            </button>
                        </div>
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                            Slug akan otomatis dibuat dari judul. Klik icon untuk regenerate.
                        </p>
                        @error('slug')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Ringkasan
                        </label>
                        <textarea name="excerpt" rows="3"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Ringkasan singkat artikel...">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Konten <span class="text-error-500">*</span>
                        </label>
                        <!-- Quill Editor Container -->
                        <div id="editor-container"></div>
                        <!-- Hidden textarea for form submission -->
                        <textarea name="content" id="content" class="hidden" required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="flex flex-col gap-9 lg:col-span-1">
                <!-- Status & Publish -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Publikasi</h3>
                    
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Status <span class="text-error-500">*</span>
                        </label>
                        <div class="relative z-20 bg-transparent dark:bg-dark-900">
                            <select name="status" id="status" required
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 relative z-20 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2 pointer-events-none">
                                <i class="fa-solid fa-chevron-down w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Waktu Publikasi
                        </label>
                        <input type="datetime-local" name="published_at" id="published_at"
                            value="{{ old('published_at') ?? now()->format('Y-m-d\TH:i') }}"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>

                    <div class="mb-4">
                        <label class="flex cursor-pointer select-none items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-400">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                class="sr-only peer" />
                            <div class="h-5 w-9 rounded-full bg-gray-200 shadow-inner dark:bg-gray-700 peer-checked:bg-brand-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all relative"></div>
                            Artikel Unggulan
                        </label>
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        <i class="fa-solid fa-check w-5 h-5"></i>
                        Simpan Artikel
                    </button>
                </div>

                <!-- Category -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Kategori</h3>
                    
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Pilih Kategori <span class="text-error-500">*</span>
                        </label>
                        <div class="relative z-20 bg-transparent dark:bg-dark-900">
                            <select name="category_id" required
                                class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 relative z-20 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2 pointer-events-none">
                                <i class="fa-solid fa-chevron-down w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                            </span>
                        </div>
                        @error('category_id')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Tidak ada kategori? 
                            <a href="{{ route('admin.article-categories.create') }}" target="_blank" class="text-brand-500 hover:text-brand-600">Buat kategori baru</a>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Gambar Utama</h3>
                    
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Upload Gambar
                        </label>
                        <input type="file" name="featured_image" accept="image/*"
                            class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400" />
                        @error('featured_image')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Format: JPG, PNG, GIF. Maksimal: 2MB.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar {
        border-radius: 0.5rem 0.5rem 0 0;
        border-color: rgb(209 213 219);
        background: white;
    }
    .dark .ql-toolbar {
        border-color: rgb(55 65 81);
        background: rgb(17 24 39);
    }
    .ql-container {
        border-radius: 0 0 0.5rem 0.5rem;
        border-color: rgb(209 213 219);
        background: white;
        font-size: 14px;
        min-height: 400px;
    }
    .dark .ql-container {
        border-color: rgb(55 65 81);
        background: rgb(17 24 39);
        color: rgb(243 244 246);
    }
    .ql-editor {
        min-height: 400px;
    }
    .dark .ql-editor.ql-blank::before {
        color: rgb(156 163 175);
    }
    .dark .ql-stroke {
        stroke: rgb(156 163 175);
    }
    .dark .ql-fill {
        fill: rgb(156 163 175);
    }
    .dark .ql-picker-label {
        color: rgb(156 163 175);
    }
    .dark .ql-picker-options {
        background: rgb(31 41 55);
        border-color: rgb(55 65 81);
    }
</style>
@endpush

@push('scripts')
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
// Initialize Quill
const quill = new Quill('#editor-container', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'align': [] }],
            ['link', 'image', 'video'],
            ['blockquote', 'code-block'],
            ['clean']
        ]
    },
    placeholder: 'Tulis konten artikel di sini...'
});

// Set initial content if exists
const contentField = document.getElementById('content');
if (contentField.value) {
    quill.root.innerHTML = contentField.value;
}

// Update hidden textarea on form submit
document.querySelector('form').addEventListener('submit', function() {
    contentField.value = quill.root.innerHTML;
});

// Also update on content change (for validation)
quill.on('text-change', function() {
    contentField.value = quill.root.innerHTML;
});

function generateSlug() {
    const title = document.getElementById('title').value;
    const slugField = document.getElementById('slug');

    if (title) {
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');

        slugField.value = slug;
    }
}

// Auto-generate slug on title input
let slugTimeout;
document.getElementById('title').addEventListener('input', function() {
    clearTimeout(slugTimeout);
    slugTimeout = setTimeout(generateSlug, 500);
});

// Auto-set published_at when status changes to published
document.getElementById('status').addEventListener('change', function() {
    const publishedAtField = document.getElementById('published_at');
    if (this.value === 'published' && !publishedAtField.value) {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        publishedAtField.value = now.toISOString().slice(0, 16);
    }
});
</script>
@endpush
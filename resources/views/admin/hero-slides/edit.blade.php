@extends('layouts.admin')

@section('title', 'Edit Slide')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                Edit Slide
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium" href="{{ route('admin.hero-slides.index') }}">Hero Slides /</a></li>
                    <li class="font-medium text-primary">Edit</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.hero-slides.index') }}"
            class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
            <i class="fa-solid fa-arrow-left w-5 h-5"></i>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 gap-9 lg:grid-cols-2">
            <!-- Left Column: Image Upload -->
            <div class="flex flex-col gap-9">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Gambar Slide</h3>
                    
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Ganti Gambar (Opsional)
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-lg relative hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors" id="drop-area">
                            <div class="space-y-2 text-center">
                                <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                    <label for="image" class="relative cursor-pointer rounded-md font-medium text-brand-500 hover:text-brand-600 focus-within:outline-none">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar</p>
                            </div>
                            <!-- Existing Image Preview -->
                            <img id="preview" src="{{ asset('assets/' . $heroSlide->image_path) }}" class="absolute inset-0 w-full h-full object-cover rounded-lg opacity-90" />
                        </div>
                        @error('image')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="flex flex-col gap-9">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Detail Slide</h3>

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Judul (Opsional)
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $heroSlide->title) }}"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Judul Slide" />
                    </div>

                    <!-- Subtitle -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Subjudul (Opsional)
                        </label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $heroSlide->subtitle) }}"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            placeholder="Subjudul Slide" />
                    </div>

                    <!-- Order -->
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Urutan
                        </label>
                        <input type="number" name="order" id="order" value="{{ old('order', $heroSlide->order) }}"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                            Angka lebih kecil akan tampil lebih dulu.
                        </p>
                    </div>

                    <!-- Is Active -->
                    <div class="mb-6">
                        <label class="flex cursor-pointer select-none items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-400">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $heroSlide->is_active) ? 'checked' : '' }}
                                class="sr-only peer" />
                            <div class="h-5 w-9 rounded-full bg-gray-200 shadow-inner dark:bg-gray-700 peer-checked:bg-brand-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all relative"></div>
                            Tampilkan Slide Ini
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <a href="{{ route('admin.hero-slides.index') }}" 
                            class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                            <i class="fa-solid fa-check w-5 h-5"></i>
                            Simpan Perubahan
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
                reader.onload = function(e) {
                    var preview = document.getElementById('preview');
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
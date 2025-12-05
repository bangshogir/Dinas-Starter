# CRITICAL #1: Create/Edit Forms Implementation Plan

## 🎯 Objective
Implementasi form create dan edit artikel yang lengkap dengan validasi dan UX yang baik.

## ⏱️ Estimasi: 2 jam

## 📋 Files to Create/Modify

### 1. Create Form
**File:** `resources/views/admin/articles/create.blade.php`

### 2. Edit Form  
**File:** `resources/views/admin/articles/edit.blade.php`

## 🏗️ Form Structure

### Main Content Area
- Title input (required, max 255)
- Slug input (auto-generate from title, editable)
- Category dropdown (nullable)
- Content textarea (will be WYSIWYG)
- Excerpt textarea (nullable, max 500)

### Sidebar Area
- Featured image upload with preview
- Status selector (published/draft/archived)
- Featured checkbox
- Published date picker (nullable)
- Save & Publish buttons

## 📝 Implementation Steps

### Step 1: Create Form View (30 min)
```blade
@extends('layouts.admin')
@section('title', 'Tambah Artikel')
@section('content')
    <div class="mb-6">
        <!-- Breadcrumb -->
        <nav>
            <ol class="flex items-center gap-2">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li>/</li>
                <li><a href="{{ route('admin.articles.index') }}">Artikel</a></li>
                <li>/</li>
                <li class="text-primary">Tambah</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Content (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title -->
                <!-- Slug -->
                <!-- Category -->
                <!-- Content -->
                <!-- Excerpt -->
            </div>

            <!-- Sidebar (1/3) -->
            <div class="space-y-6">
                <!-- Featured Image -->
                <!-- Status -->
                <!-- Featured -->
                <!-- Published Date -->
                <!-- Actions -->
            </div>
        </div>
    </form>
@endsection
```

### Step 2: Auto-Slug JavaScript (15 min)
```javascript
<script>
document.getElementById('title').addEventListener('input', function() {
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
});
</script>
```

### Step 3: Image Preview (20 min)
```javascript
<script>
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});
</script>
```

### Step 4: Form Validation (15 min)
- Add HTML5 validation attributes
- Display server-side errors with @error
- Add client-side validation feedback

### Step 5: Edit Form (20 min)
- Copy create form structure
- Pre-fill with article data
- Show current featured image
- Add delete image option

### Step 6: Testing (20 min)
- Test create flow
- Test edit flow
- Test validation
- Test image upload
- Test all field types

## ✅ Acceptance Criteria

- [ ] Form accessible from admin panel
- [ ] All fields can be input
- [ ] Auto-slug works
- [ ] Image upload works with preview
- [ ] Validation works (client & server)
- [ ] Save works (create & update)
- [ ] Redirect to show page after save
- [ ] Success message appears
- [ ] Error messages display properly
- [ ] Responsive design works

## 🎨 UI Components Needed

### Input Fields
```blade
<!-- Text Input -->
<div>
    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
        Title <span class="text-error-500">*</span>
    </label>
    <input type="text" name="title" id="title" required
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm 
               focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
               dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
        value="{{ old('title', $article->title ?? '') }}">
    @error('title')
        <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
    @enderror
</div>
```

### Textarea
```blade
<div>
    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
        Excerpt
    </label>
    <textarea name="excerpt" rows="3"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
               focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
               dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
    >{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
</div>
```

### Select Dropdown
```blade
<div>
    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
        Kategori
    </label>
    <select name="category_id"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
               focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
               dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
        <option value="">Pilih Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
```

### Image Upload
```blade
<div>
    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
        Featured Image
    </label>
    <input type="file" name="featured_image" id="featured_image" accept="image/*"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
               dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    
    <!-- Preview -->
    <div id="preview-container" class="mt-4 {{ isset($article->featured_image) ? '' : 'hidden' }}">
        <img id="preview" 
             src="{{ isset($article) && $article->featured_image ? asset('storage/'.$article->featured_image) : '' }}"
             class="w-full rounded-lg" alt="Preview">
    </div>
</div>
```

### Checkbox
```blade
<div class="flex items-center">
    <input type="checkbox" name="is_featured" id="is_featured" value="1"
        {{ old('is_featured', $article->is_featured ?? false) ? 'checked' : '' }}
        class="h-4 w-4 rounded border-gray-300 text-brand-500 
               focus:ring-2 focus:ring-brand-500/20">
    <label for="is_featured" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
        Artikel Unggulan
    </label>
</div>
```

### Action Buttons
```blade
<div class="flex gap-3">
    <button type="submit" name="status" value="draft"
        class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700
               hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
        Simpan Draft
    </button>
    <button type="submit" name="status" value="published"
        class="flex-1 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white
               hover:bg-brand-600">
        Publikasikan
    </button>
</div>
```

## 🧪 Testing Checklist

- [ ] Create article with all fields filled
- [ ] Create article with minimal fields
- [ ] Edit existing article
- [ ] Upload new image
- [ ] Change image
- [ ] Remove image
- [ ] Auto-slug generation
- [ ] Manual slug edit
- [ ] Validation errors display
- [ ] Success message after save
- [ ] Redirect after save
- [ ] Dark mode compatibility
- [ ] Responsive on mobile
- [ ] Responsive on tablet

# Plan Implementasi Fitur Berita & Artikel
## Dinas-Starter Project

## 📋 Overview
Menambahkan fitur **Berita & Artikel** dengan sistem CRUD lengkap, manajemen kategori, dan role-based permissions untuk **Super Admin**, **Admin**, dan **Author**. Menggunakan template **TailAdmin** yang sudah tersedia.

## 🗄️ Database Schema & Models

### 1. Articles Table Migration
**File:** `database/migrations/2025_12_03_create_articles_table.php`

```php
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('content');
    $table->text('excerpt')->nullable();
    $table->string('featured_image')->nullable();
    $table->enum('status', ['published', 'draft', 'archived'])->default('draft');
    $table->boolean('is_featured')->default(false);
    $table->foreignId('category_id')->constrained('article_categories');
    $table->foreignId('author_id')->constrained('users');
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->index(['status', 'published_at']);
    $table->index('category_id');
    $table->index('author_id');
    $table->index('is_featured');
});
```

### 2. Article Categories Table Migration
**File:** `database/migrations/2025_12_03_create_article_categories_table.php`

```php
Schema::create('article_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->foreignId('parent_id')->nullable()->constrained('article_categories');
    $table->boolean('is_active')->default(true);
    $table->integer('sort_order')->default(0);
    $table->timestamps();

    $table->index(['is_active', 'sort_order']);
    $table->index('parent_id');
});
```

### 3. Article Model
**File:** `app/Models/Article.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Article extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'is_featured',
        'category_id',
        'author_id',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'category_id'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Article {$this->title} has been {$eventName}");
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByAuthor($query, $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at?->format('d M Y H:i');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'published' => '<span class="badge bg-success">Published</span>',
            'draft' => '<span class="badge bg-warning">Draft</span>',
            'archived' => '<span class="badge bg-secondary">Archived</span>',
            default => '<span class="badge bg-secondary">' . $this->status . '</span>'
        };
    }
}
```

### 4. Article Category Model
**File:** `app/Models/ArticleCategory.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id')
                   ->orderBy('sort_order');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function publishedArticles(): HasMany
    {
        return $this->articles()->published();
    }

    public function getFullNameAttribute()
    {
        if ($this->parent) {
            return $this->parent->name . ' > ' . $this->name;
        }
        return $this->name;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeParentCategories($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChildCategories($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }
}
```

## 🎮 Controllers

### 1. Article Controller
**File:** `app/Http/Controllers/Admin/ArticleController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:articles.read')->only(['index', 'show']);
        $this->middleware('permission:articles.create')->only(['create', 'store']);
        $this->middleware('permission:articles.update')->only(['edit', 'update', 'publish', 'toggleFeatured']);
        $this->middleware('permission:articles.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $query = Article::with(['category', 'author']);

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('author')) {
            $query->where('author_id', $request->author);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        $articles = $query->latest()->paginate(10)->withQueryString();
        $categories = ArticleCategory::active()->ordered()->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = ArticleCategory::active()->ordered()->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:article_categories,id',
            'status' => ['required', Rule::in(['published', 'draft', 'archived'])],
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $path = $image->store('articles/featured', 'public');
            $data['featured_image'] = $path;
        }

        $data['author_id'] = auth()->id();

        // Set published_at if status is published and published_at is not set
        if ($data['status'] === 'published' && !$data['published_at']) {
            $data['published_at'] = now();
        }

        $article = Article::create($data);

        return redirect()
            ->route('admin.articles.show', $article)
            ->with('success', 'Artikel berhasil dibuat!');
    }

    public function show(Article $article)
    {
        $article->load(['category', 'author']);
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        $categories = ArticleCategory::active()->ordered()->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($article->id)],
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:article_categories,id',
            'status' => ['required', Rule::in(['published', 'draft', 'archived'])],
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }

            $image = $request->file('featured_image');
            $path = $image->store('articles/featured', 'public');
            $data['featured_image'] = $path;
        }

        // Set published_at if status is published and published_at is not set
        if ($data['status'] === 'published' && !$data['published_at'] && !$article->published_at) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()
            ->route('admin.articles.show', $article)
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        // Delete featured image
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    public function publish(Article $article)
    {
        $this->authorize('update', $article);

        $newStatus = $article->status === 'published' ? 'draft' : 'published';
        $article->update([
            'status' => $newStatus,
            'published_at' => $newStatus === 'published' ? now() : null
        ]);

        return back()->with('success', "Artikel berhasil " . ($newStatus === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft'));
    }

    public function toggleFeatured(Article $article)
    {
        $this->authorize('update', $article);

        $article->update([
            'is_featured' => !$article->is_featured
        ]);

        return back()->with('success', 'Status featured artikel berhasil diperbarui!');
    }
}
```

### 2. Article Category Controller
**File:** `app/Http/Controllers/Admin/ArticleCategoryController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:content.read')->only(['index']);
        $this->middleware('permission:content.create')->only(['create', 'store']);
        $this->middleware('permission:content.update')->only(['edit', 'update', 'updateOrder']);
        $this->middleware('permission:content.delete')->only(['destroy']);
    }

    public function index()
    {
        $categories = ArticleCategory::with(['parent', 'children', 'articles'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.article-categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = ArticleCategory::parentCategories()->active()->ordered()->get();
        return view('admin.article-categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:article_categories,slug',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:article_categories,id',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['name']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        // Set default sort order
        if (!isset($data['sort_order'])) {
            $maxOrder = ArticleCategory::where('parent_id', $data['parent_id'] ?? null)->max('sort_order');
            $data['sort_order'] = $maxOrder + 1;
        }

        ArticleCategory::create($data);

        return redirect()
            ->route('admin.article-categories.index')
            ->with('success', 'Kategori artikel berhasil dibuat!');
    }

    public function edit(ArticleCategory $articleCategory)
    {
        $parentCategories = ArticleCategory::parentCategories()
            ->active()
            ->where('id', '!=', $articleCategory->id)
            ->where(function($query) use ($articleCategory) {
                $query->where('parent_id', '!=', $articleCategory->id)
                      ->orWhereNull('parent_id');
            })
            ->ordered()
            ->get();

        return view('admin.article-categories.edit', compact('articleCategory', 'parentCategories'));
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('article_categories', 'slug')->ignore($articleCategory->id)],
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:article_categories,id',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['name']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        // Prevent circular reference
        if ($data['parent_id'] == $articleCategory->id) {
            return back()->with('error', 'Tidak bisa menjadikan kategori ini sebagai parent dari dirinya sendiri.');
        }

        $articleCategory->update($data);

        return redirect()
            ->route('admin.article-categories.index')
            ->with('success', 'Kategori artikel berhasil diperbarui!');
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        // Check if category has articles
        if ($articleCategory->articles()->exists()) {
            return back()->with('error', 'Tidak bisa menghapus kategori yang memiliki artikel.');
        }

        // Check if category has child categories
        if ($articleCategory->children()->exists()) {
            return back()->with('error', 'Tidak bisa menghapus kategori yang memiliki sub-kategori.');
        }

        $articleCategory->delete();

        return redirect()
            ->route('admin.article-categories.index')
            ->with('success', 'Kategori artikel berhasil dihapus!');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:article_categories,id',
            'orders.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $order) {
            ArticleCategory::where('id', $order['id'])
                ->update(['sort_order' => $order['sort_order']]);
        }

        return response()->json(['success' => true]);
    }
}
```

### 3. Public Article Controller
**File:** `app/Http/Controllers/Public/ArticleController.php`

```php
<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with(['category', 'author'])
            ->published()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(9);

        $featuredArticles = Article::with(['category', 'author'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = ArticleCategory::active()
            ->withCount('publishedArticles')
            ->ordered()
            ->get();

        return view('articles.index', compact('articles', 'featuredArticles', 'categories'));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published' || !$article->published_at) {
            abort(404);
        }

        $article->load(['category', 'author']);

        // Get related articles
        $relatedArticles = Article::with(['category', 'author'])
            ->published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest('published_at')
            ->take(4)
            ->get();

        // Increment view count (optional feature)
        $article->increment('views');

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function category(ArticleCategory $category)
    {
        if (!$category->is_active) {
            abort(404);
        }

        $articles = Article::with(['category', 'author'])
            ->published()
            ->byCategory($category->id)
            ->latest('published_at')
            ->paginate(9);

        return view('articles.category', compact('articles', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('articles.index');
        }

        $articles = Article::with(['category', 'author'])
            ->published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(9);

        return view('articles.search', compact('articles', 'query'));
    }
}
```

## 🛣️ Routes & Navigation

### 1. Update Routes
**File:** `routes/web.php` (tambahkan setelah existing admin routes)

```php
// Admin Articles Management
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Articles
    Route::middleware('permission:articles.read')->prefix('articles')->name('articles.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('create')->middleware('permission:articles.create');
        Route::post('/', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('store')->middleware('permission:articles.create');
        Route::get('/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'show'])->name('show');
        Route::get('/{article}/edit', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('edit')->middleware('permission:articles.update');
        Route::put('/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('update')->middleware('permission:articles.update');
        Route::delete('/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('destroy')->middleware('permission:articles.delete');
        Route::post('/{article}/publish', [App\Http\Controllers\Admin\ArticleController::class, 'publish'])->name('publish')->middleware('permission:articles.update');
        Route::post('/{article}/featured', [App\Http\Controllers\Admin\ArticleController::class, 'toggleFeatured'])->name('featured')->middleware('permission:articles.update');
    });

    // Article Categories
    Route::middleware('permission:content.read')->prefix('article-categories')->name('article-categories.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'create'])->name('create')->middleware('permission:content.create');
        Route::post('/', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'store'])->name('store')->middleware('permission:content.create');
        Route::get('/{articleCategory}/edit', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'edit'])->name('edit')->middleware('permission:content.update');
        Route::put('/{articleCategory}', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'update'])->name('update')->middleware('permission:content.update');
        Route::delete('/{articleCategory}', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'destroy'])->name('destroy')->middleware('permission:content.delete');
        Route::post('/order', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'updateOrder'])->name('order')->middleware('permission:content.update');
    });
});

// Public Articles
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [App\Http\Controllers\Public\ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [App\Http\Controllers\Public\ArticleController::class, 'show'])->name('show');
    Route::get('/category/{category:slug}', [App\Http\Controllers\Public\ArticleController::class, 'category'])->name('category');
    Route::get('/search', [App\Http\Controllers\Public\ArticleController::class, 'search'])->name('search');
});
```

### 2. Update Sidebar Navigation
**File:** `resources/views/partials/admin/sidebar.blade.php` (tambahkan sebelum menu "Pengaturan")

```blade
<!-- Berita & Artikel -->
<li class="menu">
    <a href="#menuBeritaArtikel" data-bs-toggle="collapse" class="dropdown-toggle">
        <i class="menu-icon tf-icons ti ti-news"></i>
        <div class="menu-title">Berita & Artikel</div>
    </a>
    <ul class="collapse submenu list-unstyled" id="menuBeritaArtikel" data-parent="#sidebar-wrapper">
        <li>
            <a href="{{ route('admin.articles.index') }}" class="submenu-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <span>Daftar Artikel</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.article-categories.index') }}" class="submenu-link {{ request()->routeIs('admin.article-categories.*') ? 'active' : '' }}">
                <i class="menu-icon tf-icons ti ti-folders"></i>
                <span>Kategori Artikel</span>
            </a>
        </li>
    </ul>
</li>
```

## 🎨 Views (TailAdmin Components)

### 1. Articles Index
**File:** `resources/views/admin/articles/index.blade.php`

```blade
@extends('layouts.admin')

@section('title', 'Daftar Artikel')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title mb-0">Daftar Artikel</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            @can('articles.create')
                                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i> Tambah Artikel
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter & Search -->
                    <form method="GET" action="{{ route('admin.articles.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="search" class="form-label">Pencarian</label>
                                <input type="text" class="form-control" id="search" name="search"
                                       value="{{ request('search') }}" placeholder="Cari judul atau konten...">
                            </div>
                            <div class="col-md-2">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="featured" class="form-label">Featured</label>
                                <select class="form-select" id="featured" name="featured">
                                    <option value="">Semua</option>
                                    <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured</option>
                                    <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Non-Featured</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ti ti-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Articles Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Published</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($articles as $article)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.articles.show', $article) }}" class="text-decoration-none">
                                                {{ Str::limit($article->title, 50) }}
                                            </a>
                                            @if($article->excerpt)
                                                <br><small class="text-muted">{{ Str::limit($article->excerpt, 100) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($article->category)
                                                <span class="badge bg-info">{{ $article->category->name }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $article->author->name }}</td>
                                        <td>{!! $article->statusBadge !!}</td>
                                        <td>
                                            @if($article->is_featured)
                                                <span class="badge bg-warning"><i class="ti ti-star"></i> Featured</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($article->published_at)
                                                {{ $article->formatted_published_at }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('admin.articles.show', $article) }}"
                                                           class="dropdown-item">
                                                            <i class="ti ti-eye"></i> Lihat
                                                        </a>
                                                    </li>
                                                    @can('articles.update')
                                                        <li>
                                                            <a href="{{ route('admin.articles.edit', $article) }}"
                                                               class="dropdown-item">
                                                                <i class="ti ti-edit"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.articles.publish', $article) }}"
                                                                  style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="ti ti-{{ $article->status == 'published' ? 'player-pause' : 'player-play' }}"></i>
                                                                    {{ $article->status == 'published' ? 'Archive' : 'Publish' }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.articles.featured', $article) }}"
                                                                  style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="ti ti-{{ $article->is_featured ? 'star-off' : 'star' }}"></i>
                                                                    {{ $article->is_featured ? 'Remove Featured' : 'Make Featured' }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endcan
                                                    @can('articles.delete')
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}"
                                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')"
                                                                  style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="ti ti-trash"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="ti ti-inbox text-muted mb-2" style="font-size: 2rem;"></i>
                                            <p class="text-muted mb-0">Belum ada artikel</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

## 📁 File Structure Summary

### Files to Create:
```
📁 Database
├── 📄 database/migrations/2025_12_03_create_articles_table.php
├── 📄 database/migrations/2025_12_03_create_article_categories_table.php
└── 📄 database/seeders/ArticlePermissionSeeder.php

📁 Models
├── 📄 app/Models/Article.php
└── 📄 app/Models/ArticleCategory.php

📁 Controllers
├── 📄 app/Http/Controllers/Admin/ArticleController.php
├── 📄 app/Http/Controllers/Admin/ArticleCategoryController.php
└── 📄 app/Http/Controllers/Public/ArticleController.php

📁 Views - Admin
├── 📄 resources/views/admin/articles/
│   ├── 📄 index.blade.php
│   ├── 📄 create.blade.php
│   ├── 📄 edit.blade.php
│   ├── 📄 show.blade.php
│   └── 📄 _form.blade.php
└── 📄 resources/views/admin/article-categories/
    ├── 📄 index.blade.php
    ├── 📄 create.blade.php
    ├── 📄 edit.blade.php
    └── 📄 _form.blade.php

📁 Views - Public
├── 📄 resources/views/articles/
│   ├── 📄 index.blade.php
│   ├── 📄 show.blade.php
│   ├── 📄 category.blade.php
│   └── 📄 search.blade.php

📄 Resources to Modify
├── 📄 routes/web.php
└── 📄 resources/views/partials/admin/sidebar.blade.php
```

## 🔐 Permissions & Roles

### Permission Seeder Update
**File:** `database/seeders/ArticlePermissionSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ArticlePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Articles
            'articles.create',
            'articles.read',
            'articles.update',
            'articles.delete',

            // Categories (using existing content permissions)
            'content.create',
            'content.read',
            'content.update',
            'content.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('Article permissions seeded successfully.');
    }
}
```

### Role Permissions Matrix:
| Permission | Super Admin | Admin | Author |
|-------------|-------------|-------|--------|
| articles.create | ✅ | ✅ | ✅ |
| articles.read | ✅ | ✅ | ✅ |
| articles.update | ✅ | ✅ | ✅ (own only) |
| articles.delete | ✅ | ✅ | ✅ (own only) |
| content.create | ✅ | ✅ | ❌ |
| content.read | ✅ | ✅ | ✅ |
| content.update | ✅ | ✅ | ❌ |
| content.delete | ✅ | ✅ | ❌ |

## 🚀 Implementation Steps

1. **Setup Database** (1 hari)
   - Create migrations
   - Create models with relationships
   - Update permission seeder

2. **Backend Development** (2 hari)
   - Create controllers with full CRUD
   - Setup routes
   - Implement validation
   - Add image upload functionality

3. **Admin Interface** (3-4 hari)
   - Create all admin views using TailAdmin
   - Implement search & filtering
   - Add responsive design
   - Integrate rich text editor

4. **Public Pages** (2 hari)
   - Create public article listing
   - Design article detail page
   - Implement search functionality
   - Add category pages

5. **Testing & Polish** (1-2 hari)
   - Test all features
   - Fix bugs
   - Performance optimization
   - Security review

**Total Estimated Time: 9-10 hari**

## 🎯 Key Features Implemented

✅ **Complete CRUD System** for Articles & Categories
✅ **Role-based Permissions** with Super Admin, Admin, Author roles
✅ **TailAdmin Integration** for consistent UI/UX
✅ **Rich Text Editor** for article content
✅ **Image Upload & Management** for featured images
✅ **Advanced Search & Filtering** capabilities
✅ **Public Article Pages** with SEO-friendly URLs
✅ **Activity Logging** for audit trails
✅ **Responsive Design** for mobile compatibility
✅ **Draft/Publish Workflow** with scheduled publishing
✅ **Featured Articles** system
✅ **Hierarchical Categories** with unlimited nesting
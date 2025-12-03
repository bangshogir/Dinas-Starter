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
            'category_id' => 'nullable|exists:article_categories,id',
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
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($article->id)],
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:article_categories,id',
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
        $newStatus = $article->status === 'published' ? 'draft' : 'published';
        $article->update([
            'status' => $newStatus,
            'published_at' => $newStatus === 'published' ? now() : null
        ]);

        return back()->with('success', "Artikel berhasil " . ($newStatus === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft'));
    }

    public function toggleFeatured(Article $article)
    {
        $article->update([
            'is_featured' => !$article->is_featured
        ]);

        return back()->with('success', 'Status featured artikel berhasil diperbarui!');
    }
}

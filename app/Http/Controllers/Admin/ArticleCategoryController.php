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

    public function show(ArticleCategory $articleCategory)
    {
        $articleCategory->load(['parent', 'children', 'articles.author']);
        return view('admin.article-categories.show', compact('articleCategory'));
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

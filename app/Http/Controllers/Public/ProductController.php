<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('seller_name', 'like', "%{$search}%");
            });
        }

        if ($request->has('category')) {
            $categorySlug = $request->category;
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $products = $query->latest()->paginate(12);

        // Data for Sidebar
        $popularProducts = Product::where('is_active', true)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $productCategories = \App\Models\ProductCategory::withCount('products')->get();

        return view('public.products.index', compact('products', 'popularProducts', 'productCategories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $popularProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $productCategories = \App\Models\ProductCategory::withCount('products')->get();

        return view('public.products.show', compact('product', 'popularProducts', 'productCategories'));
    }
}

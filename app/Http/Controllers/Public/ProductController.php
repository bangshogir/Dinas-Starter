<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%')
                ->orWhere('seller_name', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->paginate(12);

        return view('public.products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Popular products (Random 5 related products excluding current)
        $popularProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('public.products.show', compact('product', 'popularProducts'));
    }
}

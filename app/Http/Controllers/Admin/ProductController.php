<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('seller_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'seller_name' => 'required|string|max:255',
            'seller_phone' => 'required|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->except('image');

        // Generate Slug
        $data['slug'] = Str::slug($request->name) . '-' . Str::random(5);

        // Normalize Phone Number (08 -> 628)
        $phone = $data['seller_phone'];
        if (Str::startsWith($phone, '08')) {
            $phone = '62' . substr($phone, 1);
        }
        $data['seller_phone'] = $phone;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('products', $filename, 'public');
            $data['image'] = 'products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'seller_name' => 'required|string|max:255',
            'seller_phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->except('image');

        // Update Slug if name changed
        if ($request->name !== $product->name) {
            $data['slug'] = Str::slug($request->name) . '-' . Str::random(5);
        }

        // Normalize Phone
        $phone = $data['seller_phone'];
        if (Str::startsWith($phone, '08')) {
            $phone = '62' . substr($phone, 1);
        }
        $data['seller_phone'] = $phone;

        // Handle Image Update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('products', $filename, 'public');
            $data['image'] = 'products/' . $filename;
        }

        // Handle Checkbox
        if (!$request->has('is_active')) {
            $data['is_active'] = 0;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}

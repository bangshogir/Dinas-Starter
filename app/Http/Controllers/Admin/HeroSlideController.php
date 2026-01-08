<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('order', 'asc')->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order', 0);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hero_slides', 'public');
            $data['image_path'] = $path;
        }

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil ditambahkan');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($heroSlide->image_path && Storage::disk('public')->exists($heroSlide->image_path)) {
                Storage::disk('public')->delete($heroSlide->image_path);
            }
            $path = $request->file('image')->store('hero_slides', 'public');
            $data['image_path'] = $path;
        }

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil diperbarui');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->image_path && Storage::disk('public')->exists($heroSlide->image_path)) {
            Storage::disk('public')->delete($heroSlide->image_path);
        }
        $heroSlide->delete();
        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil dihapus');
    }
}

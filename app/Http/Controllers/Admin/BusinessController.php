<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\BusinessGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::with('categories')->latest()->get();
        return view('admin.businesses.index', compact('businesses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.businesses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'address' => 'required',
            'phones' => 'required',
            'emails' => 'required',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('businesses', 'public');
        }

        $business = Business::create($validated);
        $business->categories()->attach($request->categories);

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Comercio creado exitosamente.');
    }

    public function edit(Business $business)
    {
        $categories = Category::all();
        $selectedCategories = $business->categories->pluck('id')->toArray();
        return view('admin.businesses.edit', compact('business', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, Business $business)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'address' => 'required',
            'phones' => 'required',
            'emails' => 'required',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($business->featured_image) {
                Storage::disk('public')->delete($business->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('businesses', 'public');
        }

        $business->update($validated);
        $business->categories()->sync($request->categories);

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Comercio actualizado exitosamente.');
    }

    public function destroy(Business $business)
    {
        if ($business->featured_image) {
            Storage::disk('public')->delete($business->featured_image);
        }
        
        // Eliminar imágenes de galería
        foreach ($business->gallery as $image) {
            Storage::disk('public')->delete($image->image);
        }
        
        $business->delete();

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Comercio eliminado exitosamente.');
    }

    public function gallery(Business $business)
    {
        $images = $business->gallery;
        return view('admin.businesses.gallery', compact('business', 'images'));
    }

    public function storeGalleryImage(Request $request, Business $business)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|max:255',
        ]);

        $imagePath = $request->file('image')->store('gallery/businesses', 'public');

        BusinessGallery::create([
            'business_id' => $business->id,
            'image' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.businesses.gallery', $business)
            ->with('success', 'Imagen agregada a la galería.');
    }

    public function destroyGalleryImage(Business $business, BusinessGallery $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return redirect()->route('admin.businesses.gallery', $business)
            ->with('success', 'Imagen eliminada de la galería.');
    }
}
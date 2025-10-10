<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Business $business)
    {
        $products = $business->products;
        return view('admin.products.index', compact('business', 'products'));
    }

    public function create(Business $business)
    {
        return view('admin.products.create', compact('business'));
    }

    public function store(Request $request, Business $business)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
        }

        $validated['business_id'] = $business->id;
        Product::create($validated);

        return redirect()->route('admin.products.index', $business)
            ->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Business $business, Product $product)
    {
        return view('admin.products.edit', compact('business', 'product'));
    }

    public function update(Request $request, Business $business, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index', $business)
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Business $business, Product $product)
    {
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }
        
        // Eliminar imágenes de galería
        foreach ($product->gallery as $image) {
            Storage::disk('public')->delete($image->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index', $business)
            ->with('success', 'Producto eliminado exitosamente.');
    }

    public function gallery(Product $product)
    {
        $business = $product->business;
        $images = $product->gallery;
        return view('admin.products.gallery', compact('business', 'product', 'images'));
    }

    public function storeGalleryImage(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|max:255',
        ]);

        $imagePath = $request->file('image')->store('gallery/products', 'public');

        ProductGallery::create([
            'product_id' => $product->id,
            'image' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.products.gallery', $product)
            ->with('success', 'Imagen agregada a la galería.');
    }

    public function destroyGalleryImage(Product $product, ProductGallery $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return redirect()->route('admin.products.gallery', $product)
            ->with('success', 'Imagen eliminada de la galería.');
    }
}
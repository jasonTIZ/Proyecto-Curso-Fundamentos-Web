<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('slides', 'public');

        Slide::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image_url' => $path
        ]);

        return redirect()->route('admin.slides.index')->with('success', 'Slide creado correctamente.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'link']);

        if ($request->hasFile('image')) {
            // Delete old image only if it's a local path
            if ($slide->image_url && !preg_match('#^https?://#i', $slide->image_url)) {
                Storage::disk('public')->delete($slide->image_url);
            }
            // Store new image
            $data['image_url'] = $request->file('image')->store('slides', 'public');
        }

        $slide->update($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide actualizado correctamente.');
    }

    public function destroy(Slide $slide)
    {
        // Delete the image from storage only if it's a local path
        if ($slide->image_url && !preg_match('#^https?://#i', $slide->image_url)) {
            Storage::disk('public')->delete($slide->image_url);
        }

        $slide->delete();

        return redirect()->route('admin.slides.index')->with('success', 'Slide eliminado correctamente.');
    }
}

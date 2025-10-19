<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Business;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('businesses')->get();
        $businesses = Business::with('categories')->get();
        $selectedCategory = null;
        
        return view('web.categories', compact('categories', 'businesses', 'selectedCategory'));
    }

    public function show($id)
    {
        $selectedCategory = Category::findOrFail($id);
        $categories = Category::withCount('businesses')->get();
        $businesses = $selectedCategory->businesses;
        
        return view('web.categories', compact('categories', 'businesses', 'selectedCategory'));
    }
}
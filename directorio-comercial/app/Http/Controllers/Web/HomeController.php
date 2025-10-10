<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\Business;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('order_position', 'desc')->get();
        $recentBusinesses = Business::latest()->take(3)->get();
        $categories = Category::withCount('businesses')->get();
        
        return view('web.home', compact('slides', 'recentBusinesses', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $businesses = Business::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
        
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('business')
            ->get();
        
        return view('web.search', compact('businesses', 'products', 'query'));
    }
}
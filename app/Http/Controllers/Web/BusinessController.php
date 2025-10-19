<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function show($id)
    {
        $business = Business::with(['categories', 'products', 'gallery'])->findOrFail($id);
        return view('web.businesses.show', compact('business'));
    }
}
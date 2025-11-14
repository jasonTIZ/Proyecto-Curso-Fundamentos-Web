<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negocio;
use App\Models\Producto;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $negocios = collect();
        $productos = collect();

        if ($q !== '') {
            $negocios = Negocio::where('nombre_negocio', 'like', "%{$q}%")
                ->orWhere('descripcion', 'like', "%{$q}%")
                ->with('imagenes')
                ->limit(20)
                ->get();

            $productos = Producto::where('nombre_producto', 'like', "%{$q}%")
                ->orWhere('descripcion', 'like', "%{$q}%")
                ->with('negocio', 'imagenes') // Eager load images for products
                ->limit(20)
                ->get();
        }

        return view('search.results', compact('q','negocios','productos'));
    }
}

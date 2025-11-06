<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio;
use App\Models\CategoriaNegocio;
use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNegocios = Negocio::count();
        $totalCategorias = CategoriaNegocio::count();
        $totalProductos = Producto::count();

        // load businesses with their first image and categories
        $negocios = Negocio::with(['imagenes','categorias'])->orderBy('id_negocio','desc')->get();

        return view('admin.dashboard', compact('totalNegocios','totalCategorias','totalProductos','negocios'));
    }
}

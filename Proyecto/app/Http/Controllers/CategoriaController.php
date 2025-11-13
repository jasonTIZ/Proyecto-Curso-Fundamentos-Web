<?php

namespace App\Http\Controllers;

use App\Models\CategoriaNegocio;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        // Todas las categorías con conteo de negocios
        $categorias = CategoriaNegocio::withCount('negocios')->orderBy('nombre_categoria')->get();

        // Si el usuario selecciona una categoría específica
        $categoriaSeleccionada = null;
        $negocios = collect();

        if ($request->has('categoria')) {
            $categoriaSeleccionada = CategoriaNegocio::with('negocios.imagenes')
                ->where('id_categoria_negocio', $request->categoria)
                ->first();
            $negocios = $categoriaSeleccionada ? $categoriaSeleccionada->negocios : collect();
        }

        return view('categorias.index', compact('categorias', 'categoriaSeleccionada', 'negocios'));
    }

    public function show($id)
    {
        $categoria = CategoriaNegocio::with('negocios')->where('id_categoria_negocio', $id)->firstOrFail();
        return view('categorias.show', compact('categoria'));
    }
}

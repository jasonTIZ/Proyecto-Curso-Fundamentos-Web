<?php

namespace App\Http\Controllers;

use App\Models\CategoriaNegocio;
use App\Models\Negocio;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request, $id = null)
    {
        // Todas las categorías con conteo de negocios para el panel lateral
        $categorias = CategoriaNegocio::withCount('negocios')->orderBy('nombre_categoria')->get();

        $categoriaSeleccionada = null;
        $negocios = collect();
        $titulo = "Todas las categorías";

        if ($id) {
            $categoriaSeleccionada = CategoriaNegocio::with('negocios.imagenes')
                ->where('id_categoria_negocio', $id)
                ->firstOrFail(); // Usar firstOrFail para 404 si no existe
            $negocios = $categoriaSeleccionada->negocios;
            $titulo = $categoriaSeleccionada->nombre_categoria;
        } else {
            // Si no hay ID de categoría, mostrar todos los negocios
            $negocios = Negocio::with('imagenes', 'categorias')->orderBy('nombre_negocio')->get();
        }

        return view('categorias.index', compact('categorias', 'categoriaSeleccionada', 'negocios', 'titulo'));
    }
}

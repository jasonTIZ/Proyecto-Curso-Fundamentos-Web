<?php

namespace App\Http\Controllers;

use App\Models\CategoriaNegocio;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = CategoriaNegocio::orderBy('nombre_categoria')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function show($id)
    {
        $categoria = CategoriaNegocio::with('negocios')->where('id_categoria_negocio', $id)->firstOrFail();
        return view('categorias.show', compact('categoria'));
    }
}

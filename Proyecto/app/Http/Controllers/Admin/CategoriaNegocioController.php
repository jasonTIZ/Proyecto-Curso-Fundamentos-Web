<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaNegocio;
use Illuminate\Http\Request;

class CategoriaNegocioController extends Controller
{
    public function index()
    {
        $categorias = CategoriaNegocio::orderBy('nombre_categoria')->paginate(20);
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:150',
            'descripcion' => 'nullable|string'
        ]);

        CategoriaNegocio::create($request->only(['nombre_categoria','descripcion']));
        return redirect()->route('admin.categorias.index')->with('success','Categoría creada');
    }

    public function edit($id)
    {
        $categoria = CategoriaNegocio::where('id_categoria_negocio',$id)->firstOrFail();
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:150',
            'descripcion' => 'nullable|string'
        ]);
        
        $categoria = CategoriaNegocio::where('id_categoria_negocio',$id)->firstOrFail();
        $categoria->update($request->only(['nombre_categoria','descripcion']));
        return redirect()->route('admin.categorias.index')->with('success','Categoría actualizada');
    }

    public function destroy($id)
    {
        $categoria = CategoriaNegocio::where('id_categoria_negocio',$id)->firstOrFail();
        $categoria->delete();
        return redirect()->route('admin.categorias.index')->with('success','Categoría eliminada');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaNegocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Add this line

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
            'descripcion' => 'nullable|string',
            'categoria_negocio_imagen_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Added validation
        ]);

        $data = $request->only(['nombre_categoria','descripcion']);

        if ($request->hasFile('categoria_negocio_imagen_url')) {
            $path = $request->file('categoria_negocio_imagen_url')->store('categorias', 'public');
            $data['categoria_negocio_imagen_url'] = $path;
        }

        CategoriaNegocio::create($data);
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
            'descripcion' => 'nullable|string',
            'categoria_negocio_imagen_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Added validation
        ]);
        
        $categoria = CategoriaNegocio::where('id_categoria_negocio',$id)->firstOrFail();
        $data = $request->only(['nombre_categoria','descripcion']);

        if ($request->hasFile('categoria_negocio_imagen_url')) {
            // Delete old image if it exists and is a local file
            if ($categoria->categoria_negocio_imagen_url && !Str::startsWith($categoria->categoria_negocio_imagen_url, ['http://', 'https://'])) {
                Storage::disk('public')->delete($categoria->categoria_negocio_imagen_url);
            }
            $path = $request->file('categoria_negocio_imagen_url')->store('categorias', 'public');
            $data['categoria_negocio_imagen_url'] = $path;
        }

        $categoria->update($data);
        return redirect()->route('admin.categorias.index')->with('success','Categoría actualizada');
    }

    public function destroy($id)
    {
        $categoria = CategoriaNegocio::where('id_categoria_negocio',$id)->firstOrFail();
        
        // Delete associated image if it's a local file
        if ($categoria->categoria_negocio_imagen_url && !Str::startsWith($categoria->categoria_negocio_imagen_url, ['http://', 'https://'])) {
            Storage::disk('public')->delete($categoria->categoria_negocio_imagen_url);
        }

        $categoria->delete();
        return redirect()->route('admin.categorias.index')->with('success','Categoría eliminada');
    }
}

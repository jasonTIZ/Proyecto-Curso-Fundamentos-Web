<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaNegocio;
use App\Models\Negocio;
use App\Models\NegocioImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NegocioController extends Controller
{
    public function index()
    {
        $negocios = Negocio::orderBy('id_negocio','desc')->paginate(15);
        return view('admin.negocios.index', compact('negocios'));
    }

    public function create()
    {
        $categorias = CategoriaNegocio::orderBy('nombre_categoria')->get();
        return view('admin.negocios.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_negocio' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'images.*' => 'nullable|image|max:4096',
            'categorias' => 'nullable|array',
            'categorias.*' => 'exists:categoria_negocio,id_categoria_negocio',
        ]);

        $data = $request->only(['nombre_negocio','descripcion','provincia','canton','distrito','barrio','otras_senas','telefono','email','facebook_url','instagram_url','tiktok_url','iframe_ubicacion']);
        $negocio = Negocio::create($data);

        // Sync categories
        if ($request->has('categorias')) {
            $negocio->categorias()->sync($request->categorias);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file->isValid()) continue;
                // store on the public disk inside 'negocios' folder
                $path = $file->store('negocios', 'public');
                NegocioImagen::create([
                    'id_negocio' => $negocio->id_negocio,
                    'url_imagen' => $path,
                ]);
            }
        }

        return redirect()->route('admin.negocios.index')->with('success','Negocio creado');
    }

    public function edit($id)
    {
        $negocio = Negocio::with('categorias')->where('id_negocio', $id)->firstOrFail();
        $categorias = CategoriaNegocio::orderBy('nombre_categoria')->get();
        return view('admin.negocios.edit', compact('negocio', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $negocio = Negocio::where('id_negocio',$id)->firstOrFail();

        $validated = $request->validate([
            'nombre_negocio' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'images.*' => 'nullable|image|max:4096',
            'categorias' => 'nullable|array',
            'categorias.*' => 'exists:categoria_negocio,id_categoria_negocio',
        ]);

        $negocio->update($request->only(['nombre_negocio','descripcion','provincia','canton','distrito','barrio','otras_senas','telefono','email','facebook_url','instagram_url','tiktok_url','iframe_ubicacion']));

        // Sync categories
        $negocio->categorias()->sync($request->categorias ?? []);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file->isValid()) continue;
                $path = $file->store('negocios', 'public');
                NegocioImagen::create([
                    'id_negocio' => $negocio->id_negocio,
                    'url_imagen' => $path,
                ]);
            }
        }

        return redirect()->route('admin.negocios.index')->with('success','Negocio actualizado');
    }

    public function destroyImage($negocioId, $imagenId)
    {
        $image = NegocioImagen::where('id_imagen_negocio', $imagenId)->where('id_negocio', $negocioId)->firstOrFail();
        
        // The 'url_imagen' field now stores the relative path, which can be used directly.
        if ($image->url_imagen && Storage::disk('public')->exists($image->url_imagen)) {
            Storage::disk('public')->delete($image->url_imagen);
        }
        
        $image->delete();
        return back()->with('success','Imagen eliminada');
    }

    public function destroy($id)
    {
        $negocio = Negocio::with('imagenes')->where('id_negocio', $id)->firstOrFail();

        // Delete all associated images from storage
        foreach ($negocio->imagenes as $imagen) {
            try {
                // Assumes url_imagen stores the full URL like /storage/path/to/image.jpg
                // We need to convert it to a relative path for the Storage facade
                $path = str_replace('/storage/', '', $imagen->url_imagen);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            } catch (\Exception $e) {
                // Log error or ignore, but don't block the deletion of the business
            }
        }

        // The 'negocio_imagen' records will be deleted by the DB cascade
        // Now, delete the business
        $negocio->delete();

        return redirect()->route('admin.negocios.index')->with('success', 'Negocio y todas sus imágenes han sido eliminados.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.negocios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_negocio' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'images.*' => 'nullable|image|max:4096'
        ]);

        $data = $request->only(['nombre_negocio','descripcion','provincia','canton','distrito','barrio','otras_senas','telefono','email','facebook_url','instagram_url','tiktok_url','iframe_ubicacion']);
        $negocio = Negocio::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file->isValid()) continue;
                // store on the public disk inside 'negocios' folder
                $path = $file->store('negocios', 'public');
                $url = Storage::url($path); // /storage/negocios/...
                NegocioImagen::create([
                    'id_negocio' => $negocio->id_negocio,
                    'url_imagen' => $url,
                ]);
            }
        }

        return redirect()->route('admin.negocios.index')->with('success','Negocio creado');
    }

    public function edit($id)
    {
        $negocio = Negocio::where('id_negocio',$id)->firstOrFail();
        return view('admin.negocios.edit', compact('negocio'));
    }

    public function update(Request $request, $id)
    {
        $negocio = Negocio::where('id_negocio',$id)->firstOrFail();

        $validated = $request->validate([
            'nombre_negocio' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'images.*' => 'nullable|image|max:4096'
        ]);

        $negocio->update($request->only(['nombre_negocio','descripcion','provincia','canton','distrito','barrio','otras_senas','telefono','email','facebook_url','instagram_url','tiktok_url','iframe_ubicacion']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file->isValid()) continue;
                $path = $file->store('negocios', 'public');
                $url = Storage::url($path);
                NegocioImagen::create([
                    'id_negocio' => $negocio->id_negocio,
                    'url_imagen' => $url,
                ]);
            }
        }

        return redirect()->route('admin.negocios.index')->with('success','Negocio actualizado');
    }

    public function destroyImage($negocioId, $imagenId)
    {
        $image = NegocioImagen::where('id_imagen_negocio', $imagenId)->where('id_negocio', $negocioId)->firstOrFail();
        // delete file from storage if exists
        try {
            // stored URL is like /storage/negocios/xxx.jpg -> remove '/storage/' to get path on public disk
            $publicPath = ltrim(str_replace('/storage/', '', $image->url_imagen), '/');
            if (Storage::disk('public')->exists($publicPath)) {
                Storage::disk('public')->delete($publicPath);
            }
        } catch (\Exception $e) {
            // ignore storage errors
        }
        $image->delete();
        return back()->with('success','Imagen eliminada');
    }

    public function destroy($id)
    {
        $negocio = Negocio::where('id_negocio',$id)->firstOrFail();
        $negocio->delete();
        return redirect()->route('admin.negocios.index')->with('success','Negocio eliminado');
    }
}

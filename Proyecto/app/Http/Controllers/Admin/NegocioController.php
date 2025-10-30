<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio;
use Illuminate\Http\Request;

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
        $data = $request->only(['nombre_negocio','descripcion','provincia','canton','distrito','barrio','otras_senas','telefono','email','facebook_url','instagram_url','tiktok_url','iframe_ubicacion']);
        $negocio = Negocio::create($data);
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
        $negocio->update($request->all());
        return redirect()->route('admin.negocios.index')->with('success','Negocio actualizado');
    }

    public function destroy($id)
    {
        $negocio = Negocio::where('id_negocio',$id)->firstOrFail();
        $negocio->delete();
        return redirect()->route('admin.negocios.index')->with('success','Negocio eliminado');
    }
}

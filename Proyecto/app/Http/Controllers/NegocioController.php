<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;

class NegocioController extends Controller
{
    public function show($id)
    {
        $negocio = Negocio::with(['imagenes','productos','categorias'])->where('id_negocio', $id)->firstOrFail();
        return view('negocios.show', compact('negocio'));
    }
}

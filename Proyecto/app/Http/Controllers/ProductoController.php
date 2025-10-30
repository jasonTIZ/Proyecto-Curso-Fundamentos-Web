<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function show($id)
    {
        $producto = Producto::with('imagenes','negocio')->where('id_producto', $id)->firstOrFail();
        return view('productos.show', compact('producto'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ProductoImagen;
use App\Models\Negocio;
use App\Models\CategoriaProducto;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('negocio')->orderBy('id_producto','desc')->paginate(15);
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $negocios = Negocio::orderBy('nombre_negocio')->get();
        $categorias = CategoriaProducto::orderBy('nombre_categoria')->get();
        return view('admin.productos.create', compact('negocios','categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_producto' => 'required|string|max:150',
            'id_categoria' => 'required|exists:categoria_producto,id_categoria',
            'id_negocio' => 'required|exists:negocio,id_negocio',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'images.*' => 'nullable|image|max:4096'
        ]);

        $data = $request->only(['nombre_producto','id_categoria','id_negocio','precio','descripcion']);
        $producto = Producto::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file->isValid()) continue;
                $path = $file->store('productos', 'public');
                $url = Storage::url($path);
                ProductoImagen::create([
                    'id_producto' => $producto->id_producto,
                    'url_imagen' => $url
                ]);
            }
        }

        return redirect()->route('admin.productos.index')->with('success','Producto creado');
    }

    public function edit($id)
    {
        $producto = Producto::where('id_producto',$id)->with('imagenes','negocio')->firstOrFail();
        $negocios = Negocio::orderBy('nombre_negocio')->get();
        $categorias = CategoriaProducto::orderBy('nombre_categoria')->get();
        return view('admin.productos.edit', compact('producto','negocios','categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::where('id_producto',$id)->firstOrFail();

        $validated = $request->validate([
            'nombre_producto' => 'required|string|max:150',
            'id_categoria' => 'required|exists:categoria_producto,id_categoria',
            'id_negocio' => 'required|exists:negocio,id_negocio',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'images.*' => 'nullable|image|max:4096'
        ]);

        $producto->update($request->only(['nombre_producto','id_categoria','id_negocio','precio','descripcion']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file->isValid()) continue;
                $path = $file->store('productos', 'public');
                $url = Storage::url($path);
                ProductoImagen::create([
                    'id_producto' => $producto->id_producto,
                    'url_imagen' => $url
                ]);
            }
        }

        return redirect()->route('admin.productos.index')->with('success','Producto actualizado');
    }

    public function destroyImage($productoId, $imagenId)
    {
        $image = ProductoImagen::where('id_imagen', $imagenId)->where('id_producto', $productoId)->firstOrFail();
        try {
            $publicPath = ltrim(str_replace('/storage/', '', $image->url_imagen), '/');
            if (Storage::disk('public')->exists($publicPath)) {
                Storage::disk('public')->delete($publicPath);
            }
        } catch (\Exception $e) {
            // ignore
        }
        $image->delete();
        return back()->with('success','Imagen eliminada');
    }

    public function destroy($id)
    {
        $producto = Producto::where('id_producto',$id)->firstOrFail();
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success','Producto eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\CategoriaNegocio;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // show latest negocios
        $negocios = Negocio::orderBy('id_negocio', 'desc')->take(3)->get();
        // Get slides from the dedicated slides table
        $slides = Slide::orderBy('created_at', 'desc')->get();
        $categorias = CategoriaNegocio::orderBy('nombre_categoria')->get();

        return view('home', compact('negocios', 'slides', 'categorias'));
    }
}

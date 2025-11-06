<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // show latest negocios
    $negocios = Negocio::orderBy('id_negocio', 'desc')->take(6)->get();
    // Use recent negocios with images as slider items (no separate slides table)
    $slides = Negocio::whereHas('imagenes')->orderBy('id_negocio','desc')->take(5)->get();
    return view('home', compact('negocios','slides'));
    }
}

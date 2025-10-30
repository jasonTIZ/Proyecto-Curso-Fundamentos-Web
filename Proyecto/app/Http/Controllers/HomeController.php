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
        return view('home', compact('negocios'));
    }
}

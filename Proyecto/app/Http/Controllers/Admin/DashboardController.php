<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNegocios = Negocio::count();
        return view('admin.dashboard', compact('totalNegocios'));
    }
}

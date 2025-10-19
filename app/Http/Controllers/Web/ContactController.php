<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Aquí puedes implementar el envío de correo
        // Por ahora solo retornamos un mensaje de éxito
        
        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactBusinessMail; // Import the Mailable class

class NegocioController extends Controller
{
    public function show($id)
    {
        $negocio = Negocio::with(['imagenes', 'productos', 'categorias'])->where('id_negocio', $id)->firstOrFail();
        return view('negocios.show', compact('negocio'));
    }

    public function contact(Request $request, $id)
    {
        $negocio = Negocio::where('id_negocio', $id)->firstOrFail();

        $data = $request->validate([ // Use $request->validate() directly
            'nombre_interesado' => 'required|string|max:150',
            'telefono_interesado' => 'required|string|max:20',
            'correo_interesado' => 'required|email|max:150',
            'mensaje' => 'required|string|max:5000',
        ]);

        if (!$negocio->email) {
            return back()->with('error', 'Este negocio no tiene un correo electrónico de contacto configurado.');
        }

        try {
            Mail::to($negocio->email)->send(new ContactBusinessMail($negocio, $data));
        } catch (\Exception $e) {
            // Log the error if needed: Log::error($e->getMessage());
            return back()->with('error', 'Hubo un problema al enviar el correo. Por favor, intenta de nuevo más tarde.');
        }

        return back()->with('success', '¡Tu mensaje ha sido enviado con éxito!');
    }
}

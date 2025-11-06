<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsuarioWebmaster;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = UsuarioWebmaster::where('email', $data['email'])->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Credenciales inválidas'])->withInput();
        }

        $pw = $data['password'];
        $stored = $user->contrasena;

        $ok = false;
        // try common checks: password_verify for hashed, or direct compare for plain text
        try {
            if (password_verify($pw, $stored)) {
                $ok = true;
            }
        } catch (\Throwable $e) {
            // ignore
        }
        if (!$ok && $pw === $stored) {
            $ok = true;
        }

        if (!$ok) {
            return back()->withErrors(['email' => 'Credenciales inválidas'])->withInput();
        }

        // login: store admin id and name in session
        session(['admin_id' => $user->id_webmaster, 'admin_name' => $user->nombre]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id','admin_name']);
        return redirect()->route('admin.login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {

        // Validar info
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Preguntar si las credenciales son incorrectas
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // Redireccionar al muro
        return redirect()->route('posts.index', auth()->user()->username);

    }

}

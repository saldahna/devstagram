<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {

        //dd($request); <- Muestra todas la variables enviadas
        //dd($request->get('name'));

        /*
          Se puede modificar el request para que no lance el error nativo de Laravel, no es recomendable modificar el request
          El método slug convierte el string en url "nombre-usuario-1"
        */
        $request->request->add(['username' => Str::slug($request->username)]);

        // VALIDACIÓN
        $this->validate($request, [
            'name' => 'required|min:10',
            'username' => 'required|min:6|max:16|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        // INSERTANDO REGISTROS
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // AUTENTICAR
        /* auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]); */

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // REDIRECCIONANDO
        return redirect()->route('posts.index', auth()->user()->username);

    }
}

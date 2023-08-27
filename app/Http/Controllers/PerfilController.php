<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    /*
     * Se usa el middleware de auth para que la edición
     * del perfil solo sea visible para usuarios
     * autenticados
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        
        return view('perfil.index');

    }

    public function store(Request $request) {

        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request, [
            'username' => ['required', 'min:6', 'max:16', 'unique:users,username,'.auth()->user()->id, 'not_in:editar-perfil,twitter'],
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
        ]);

        if( $request->imagen ) {

            $imagen = $request->file('imagen');

            // Generar un ID unico para cada imagen
            $nombreImagen = Str::uuid().".".$imagen->extension();

            // Imagen que se guardará en el servidor
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            // Crear la ruta donde se guardarán las imagenes     uploads/234234233540989.jpg
            $imagenPath = public_path('perfiles').'/'.$nombreImagen;

            // Mover las imagenes a la ruta anterior
            $imagenServidor->save($imagenPath);

        }

        # Traer la información del usuario que está modificando
        $usuario = User::find( auth()->user()->id );

        # Guardar cambios
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->email = $request->email;

        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);

    }

}

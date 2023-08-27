<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Auth\Middleware\Authorize;

class PostController extends Controller
{
    /*
    | El middleware se ejecuta antes del index 
    | para verificar que el usuario esté autenticado
    | Dentro de except, se agregan las páginas que no necesitan autenticación,
    | pero que necesitan una cuenta para interactuar con la página (Me Gusta, Comentarios, etc)
    */
    public function __construct() {
        
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user) {

        // dd($user->id);
        // $posts = Post::where('user_id', $user->id)->get();
        // $posts = Post::where('user_id', $user->id)->simplePaginate(4); "Anterior|Siguiente"
        $posts = Post::where('user_id', $user->id)->latest()->paginate(12);
        
        return view('dashboard', [
            'user' => $user, 
            'posts' => $posts 
        ]);

    }

    public function create() {

        // dd('Creando post...');

        return view('posts.create');

    }

    public function store(Request $request) {

        //dd('Creando publicación...');

        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Almacenar el post en la bd
        /* Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]); */

        //Otra forma de crear registros
        /* $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); */

        // Guardar post usando relaciones
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        // Retornar al muro del usuario
        return redirect()->route('posts.index', auth()->user()->username);

    }

    public function show(User $user, Post $post) {

        return view('posts.show', [ 
            'post' => $post,
            'user' => $user
        ]);

    }

    /*
    | Gracias a Route Model Binding, se puede identificar,
    | en que post se está presionando para eliminar,
    | solo con especificar (Post $post) en la función
    */
    public function destroy(Post $post) {
        
        /*
        | Se puede usar un Policy
        | Se crea desde terminal: php artisan make:policy PostPolicy --model=Post
        */
        $this->authorize('delete', $post);
        $post->delete();

        # Eliminar la imagen
        $imagePath = public_path('uploads/'.$post->imagen);

        if( File::exists($imagePath) ) {
            unlink($imagePath);
        }

        return redirect()->route('posts.index', auth()->user()->username);

    }

}

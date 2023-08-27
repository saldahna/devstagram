<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /*
     * El 'middleware' ayuda a que, si el usuario
     * no está autenticado, lo redireccione a la
     * página de inicio de sesión
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /* public function index() {
        dd('home');
    } */

    /*
     * Solito se manda a llamar, como un constructor
     */
    public function __invoke() {

        /*
         * Obtener información de las cuentas que seguimos
         * 'plug(campo)' trae campos específicos
         * 'where' solo busca un registro
         * 'whereIn' busca un arreglo
         */
        $ids = auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(12);

        return view('home', ['posts' => $posts]);

    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    
    public function store(Request $request) {

        // Se guarda en un arreglo
        //$input = $request->all();

        $imagen = $request->file('file');

        // Generar un ID unico para cada imagen
        $nombreImagen = Str::uuid().".".$imagen->extension();

        // Imagen que se guardará en el servidor
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        // Crear la ruta donde se guardarán las imagenes     uploads/234234233540989.jpg
        $imagenPath = public_path('uploads').'/'.$nombreImagen;

        // Mover las imagenes a la ruta anterior
        $imagenServidor->save($imagenPath);

        // retorna el arreglo convertido a formato json
        return response()->json(['imagen' => $nombreImagen]);

    }

}

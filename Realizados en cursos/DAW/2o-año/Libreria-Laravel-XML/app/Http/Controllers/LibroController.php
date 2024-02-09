<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    //funcion que lista libros
    public function cargarLibros(){
        $libro=new Libro();
        $libros_json=$libro->cargarLibros();
        return response()->json($libros_json, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }
    //funcion que lista libros por genero
    public function cargarLibrosPorGenero($genero) {
        try {
            $libro = new Libro();
            $libros_json = $libro->cargarLibrosPorGenero($genero);

            return response()->json($libros_json, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cargar libros por género'+$e->getMessage()], 500);
        }
    }
}

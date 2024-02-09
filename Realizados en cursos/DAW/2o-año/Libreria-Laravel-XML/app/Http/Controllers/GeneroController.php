<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    //
    // public function listarGeneros(){
    //     $genero = new Genero();
    //     $generos=$genero->cargarGeneros();
    //     $generos_json=json_encode($generos,true);
    //     return $generos_json;
    //   }
    public function listarGeneros()
    {
        $generos = Genero::cargarGeneros();
        $generos_json = json_encode($generos, true);
        return $generos_json;
    }
}

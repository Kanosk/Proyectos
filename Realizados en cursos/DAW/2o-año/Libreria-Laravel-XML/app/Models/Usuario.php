<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    function comprobar_usuario($usuario,$password){
        $datos = simplexml_load_file(storage_path("app/public/configuracion.xml"));
        $usuarioConf = $datos->xpath("//usuario");
        $userXML =explode("@",$usuarioConf[0]);
        $claveConf = $datos->xpath("//clave");
        $confUsu = [];
        $confUsu[] = $usuarioConf[0];
        $confUsu[] = $claveConf[0];
        $confUsu[] = $userXML[0];


        //aqui lo puse asi para poner solo root, si quieres iniciar sesion con el mail es cambiar el 2 por el 0
        return ($usuario == $confUsu[2] && $password == $confUsu[1]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table ='usuarios';

    function comprobarUsuario($usuario,$clave){
        $listaUsuarios=Usuario::all();
        foreach($listaUsuarios as $userdb){
            if($userdb->user == $usuario && $userdb->password == $clave){
                return true;
            }
        }
        return false;
    }
    public static function comprobarSesion(){
        session_start();
        if (isset($_SESSION['usuario'])) {
            return true;
        }
        return false;
    }
    public function logout(){
        $this->comprobarSesion();
        $_SESSION = array();
        session_destroy();
        setcookie(session_name(), 123, time() - 1000);
        return true;
    }
}

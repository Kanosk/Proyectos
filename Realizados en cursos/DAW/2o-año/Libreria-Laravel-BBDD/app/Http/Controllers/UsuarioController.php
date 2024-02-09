<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'usuario' => 'required',
            'clave' => 'required'
        ]);

        $usuario = new Usuario();
        $datosUsuario = $usuario->comprobarUsuario($request->usuario, $request->clave);

        if ($datosUsuario === false || $datosUsuario == null) {
            return response()->json(["respuesta" => false]);
        } else {
            session_start();
            $_SESSION['usuario'] = $request->usuario;
            $_SESSION['carrito'] = [];
            return response()->json(["respuesta" => true, "usuario" => $request->usuario]);
        }
    }

    public function logout(){
        $sesion = new Usuario();
        $respuesta = $sesion->logout();
        return response()->json($respuesta);
    }

    public function checkSession(){
        $sesion = new Usuario();
        $respuesta = $sesion->comprobarSesion();
        if ($respuesta) {
            return response()->json(["sesion_iniciada" => true, "usuario" => $_SESSION['usuario']]);
        } else {
            return response()->json(["sesion_iniciada" => false]);
        }
    }

}

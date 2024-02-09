<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function login(String $mensaje=""){
        return view("login",["mensaje"=>$mensaje]);
    }
    //funcion para hacer login con laravel directamente
    public function iniciarSesion(Request $request){
        $user=new Usuario();
        if($user->comprobar_usuario($request->usuario,$request->password)){
            session_start();
            session_regenerate_id();
            session(['usuario'=>$request->usuario]);
            session(['carrito'=>[]]);
            // $_SESSION['usuario']=$request->usuario;
            // $_SESSION['carrito']=[""];
            echo"TRUE";
            // return view("principal");

        }else{
            $this->cerrarSesion();
            $mensaje="<p style='color:red'>Hubo un fallo en el login, Error en usuario o contraseña</p>";
            return $this->login($mensaje);
        }
    }

    public function principal(){
        session_start();
        return view("principal");
    }

    //funcion para hacer logout
    public function cerrarSesion(){
        session_start();
        unset($_SESSION['usuario']);
        unset($_SESSION['carrito']);
        session_unset();
        session_destroy();

        // Eliminación de Cookies asociadas a la sesión de Laravel y PHP
        setcookie("XSRF-TOKEN", " ", time() - 1000,"/");
        setcookie("laravel_session", " ", time() - 1000,"/");
        setcookie(session_name(), " ", time() - 1000,"/");

        return redirect("login");

    }
    //logout desde AJAX
    public function cerrarSesionAjax(){
        $this->cerrarSesion();
        return response()->json(['mensaje'=>'Sesión cerrada']);
    }


}


<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function registrar(Request $request){
        //TODO: validar datos

        $usuario = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make($request->password)
            ]
        );

        $permisos = explode(',', $request->permisos);

        $token = $usuario->createToken($request->alias, $permisos)->plainTextToken;

        return response()->json(['data' => $usuario, 'Token' => $token]);

    }

    public function usuarios(){

        return response()->json(User::all());
    }


}

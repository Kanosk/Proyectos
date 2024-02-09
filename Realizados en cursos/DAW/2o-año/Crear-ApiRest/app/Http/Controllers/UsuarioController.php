<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Resources\UsuarioResource;
use App\Http\Resources\UsuarioCollection;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Http\Requests\DeleteUsuarioRequest;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return new UsuarioCollection($usuarios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        return new UsuarioResource(Usuario::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        $filtroPost = request()->query('post');
        if($filtroPost){
            return new UsuarioResource($usuario->loadMissing('posts'));
        }
        return new UsuarioResource($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario , DeleteUsuarioRequest $request)
    {
        $usuario->delete();
    }
}

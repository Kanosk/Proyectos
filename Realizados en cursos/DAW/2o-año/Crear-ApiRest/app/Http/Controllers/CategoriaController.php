<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\CategoriaCollection;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Requests\DeleteCategoriaRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categoria = Categoria::paginate(10);
       return new CategoriaCollection($categoria);
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
    public function store(StoreCategoriaRequest $request)
    {
        return new CategoriaResource(Categoria::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        $filtroPost = request()->query('post');
        if($filtroPost){
            return new CategoriaResource($categoria->loadMissing('posts'));
        }
        return new CategoriaResource($categoria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria, DeleteCategoriaRequest $categoriaRequest)
    {
        $categoria->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        try {
            $listaCategoria = Categoria::all();
            return response()->json($listaCategoria, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);

            $categoria = new Categoria;
            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->save();

            return response()->json([
                'success' => true,
                'message' => 'Categoría añadida con exito',
                'categoria' => $categoria,
            ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error, no se pudo añadir Categoría',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function update(Request $request, $id){
        try{
            $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);
            $cat = Categoria::find($id);
            if($cat){
                $cat->nombre = $request->nombre;
                $cat->descripcion = $request->descripcion;
                $cat->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Categoría modificada con éxito',
                 ], 200 , [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Categoría no modificada',
                ], 404);
            }
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ],500);
        }
    }

    public function destroy($id){
        try {
            $categoria = Categoria::find($id);

            //buscamos los productos que pertenezcan a la categoria y los eliminamos
            $producto=Producto::all()->where('id_cat',$id);
            foreach($producto as $prod){
                $prod->delete();
            }

            if ($categoria) {
                $categoria->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Categoría eliminada con éxito',
                ], 200 , [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Categoría no encontrada',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al eliminar la categoría',
            ], 500);
        }
    }

    public function show($id){
        try {
            $categoria = Categoria::find($id);
            return response()->json($categoria, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

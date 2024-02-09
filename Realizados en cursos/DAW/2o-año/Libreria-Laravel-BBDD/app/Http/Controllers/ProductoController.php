<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function index($id){
        try {
            $listaProducto = Producto::where('id_cat',$id)->get();
            return response()->json($listaProducto, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id){
        try {
            $producto = Producto::find($id);

            $carrito = new CarritoController;
            $carrito->destroyTotal($id);

            if ($producto) {
                $producto->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Producto eliminado con éxito',
                ], 200 , [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no encontrada',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al eliminar el producto',
            ], 500);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'stock' => 'required',
                'id_cat' => 'required',
            ]);

            $producto = new Producto;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->stock = $request->stock;
            $producto->id_cat = $request->id_cat;
            $producto->save();

            return response()->json([
                'success' => true,
                'message' => 'Producto añadido con exito',
                'producto' => $producto,
            ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error, no se pudo añadir producto',
            ], 500);
        }
    }

    public function quitarStock($id,$cantidad){
        try {
            $producto = Producto::find($id);
            if ($producto) {
                $producto->stock=max(0,$producto->stock - $cantidad);
                $producto->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Descontada '.$cantidad .' unidad/es',
                ], 200 , [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no encontrada',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al eliminar el producto',
                'error' => 'el error es '+$e->getMessage(),
            ], 500);
        }
    }

    public function addStock($id, $cantidad){
        try {
            $producto = Producto::find($id);
            if ($producto) {
                $producto->stock=max(0,$producto->stock + $cantidad);
                $producto->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Añadida/s '.$cantidad .' unidad/es',
                ], 200 , [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no encontrado',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al añadir el producto',
                'error' => 'el error es '+$e->getMessage(),
            ], 500);
        }
    }
}

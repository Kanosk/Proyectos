<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;

class CarritoController extends Controller
{


    /*Esto es por si se quiere usar la tabla, seria cambiarle el nombre a CarritoController
    y el que pone CarritoController a CarritoController-session
    */
    public function index(){
        try {
            $listaCarrito = Carrito::join('productos', 'carrito.cod_producto', '=', 'productos.id')
            ->select('carrito.id', 'productos.nombre', 'productos.descripcion', 'productos.stock', 'carrito.stock')
            ->where('carrito.stock','>',0)
            ->get();
            $this->actualizaCarrito($listaCarrito);
            $this->limpieza();
            return response()->json($listaCarrito, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function actualizaCarrito($data){
        session(['carrito' =>[]]);
        session(['carrito' =>$data]);
    }

    public function store(Request $request){
        try {
            $request->validate([
                'cod_producto' => 'required',
                'stock' => 'required',
            ]);
            $id=$request->cod_producto;
            $cantidad = $request->stock;

            $carrito = Carrito::where('cod_producto',$id)->first();
            if($carrito){
                $carrito->stock += $cantidad;
                $carrito->save();
            }else{
                $carrito = new Carrito;
                $carrito->cod_producto = $id;
                $carrito->stock = $cantidad;
                $carrito->save();
            }
            //actualizamos stock de producto
            $productoController = new ProductoController;
            $productoController->quitarStock($id, $cantidad);
            return response()->json([
                'success' => true,
                'message' => 'Producto añadido con exito al carrito',
                'producto' => $carrito,
            ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error, no se pudo añadir producto'.$e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id,$cantidad){
        try {
            $carrito = Carrito::find($id);
            if ($carrito) {
                if($carrito->stock == 0){
                    $this->limpieza();
                }else{
                    $carrito->stock=max(0,$carrito->stock - $cantidad);
                    $carrito->save();
                }

                $productoController = new ProductoController;
                $productoController->addStock($id, $cantidad);
                return response()->json([
                    'success' => true,
                    'message' => 'Descontado el producto',
                ], 200 , [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Carrito no encontrada',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al eliminar el carrito',
                'error' => 'el error es '.$e->getMessage(),
            ], 500);
        }
    }

    public function destroyTotal($id){
        try {
            $carrito = Carrito::where('cod_producto',$id);
            if ($carrito) {
                $carrito->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Producto del carrito eliminado con éxito',
                ], 200 , [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto del carrito no encontrado',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al eliminar el producto del carrito',
            ], 500);
        }
    }

    public function limpieza(){
        $elim=Carrito::all()->where('stock',0);
        foreach($elim as $clean){
            $clean->delete();
        }
    }


}

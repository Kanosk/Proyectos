<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductoController;

class CarritoController extends Controller
{
    public function index(){
        try {
            $carrito = session('carrito', []);
            if (empty($carrito)) {
                return response()->json([
                    'message' => 'El carrito está vacío',
                    'isEmpty' => true,
                ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
            $productoIds = array_keys($carrito);
            $listaCarrito = Producto::whereIn('id', $productoIds)
                ->select('id', 'nombre', 'descripcion', 'stock')
                ->get();
            foreach ($listaCarrito as &$producto) {
                $id = $producto->id;
                $producto->stock = $carrito[$id]['stock'];
            }
            return response()->json($listaCarrito, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'cod_producto' => 'required',
                'stock' => 'required',
            ]);
            $id=$request->cod_producto;
            $cantidad = $request->stock;

            $carrito = session('carrito', []);
            if(array_key_exists($id,$carrito)){
                $carrito[$id]['stock'] +=$cantidad;
            }else{
                $carrito[$id] = [
                    'cod_producto' => $id,
                    'stock' => $cantidad,
                ];
            }
            session(['carrito' => $carrito]);
            //actualizamos stock de producto
            $productoController = new ProductoController;
            $productoController->quitarStock($id, $cantidad);
            return response()->json([
                'success' => true,
                'message' => 'Producto añadido con exito al carrito',
                'producto' => $carrito[$id],
            ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error, no se pudo añadir producto'.$e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id, $cantidad){
        try {
            $carrito = session('carrito', []);
            if (array_key_exists($id, $carrito)) {
                $carrito[$id]['stock'] = max(0, $carrito[$id]['stock'] - $cantidad);

                if ($carrito[$id]['stock'] == 0) {
                    unset($carrito[$id]);
                }

                session(['carrito' => $carrito]);

                $productoController = new ProductoController;
                $productoController->addStock($id, $cantidad);

                return response()->json([
                    'success' => true,
                    'message' => 'Producto descontado del carrito',
                ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no encontrado en el carrito',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al descontar el producto del carrito',
                'error' => 'El error es ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyTotal($id){
        try {
            $carrito = session('carrito', []);

            if (array_key_exists($id, $carrito)) {
                unset($carrito[$id]);

                session(['carrito' => $carrito]);

                return response()->json([
                    'success' => true,
                    'message' => 'Producto eliminado del carrito con éxito',
                ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no encontrado en el carrito',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Se produjo un error al eliminar el producto del carrito',
                'error' => 'El error es ' . $e->getMessage(),
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Pedido;
class PedidoController extends Controller
{
    public function completarPedido(){
        $elementosCarrito = Carrito::all();
        $elementosCarritoSession = session('carrito', []);

        //en caso de que se use la tabla en vez de la sesion
        foreach ($elementosCarrito as $elemento) {
            Pedido::create([
                'cod_carrito' => $elemento->id,
                'cantidad' => $elemento->stock,
            ]);
        }

        //por si se usa la sesion en lugar de la tabla
        foreach ($elementosCarritoSession as $key => $elemento) {
            Pedido::create([
                'cod_carrito' => $key,
                'cantidad' => $elemento['stock'],
            ]);
        }

        //vaciamos tanto la tabla como la sesion
        session(['carrito' => []]);
        Carrito::truncate();

        return response()->json([
            'success' => true,
            'message' => "Pedido Realizado"
        ]);
    }
}

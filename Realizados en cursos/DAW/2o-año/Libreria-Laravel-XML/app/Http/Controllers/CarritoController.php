<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class CarritoController extends Controller
{
    public function cargarLibros(){
        $libros = new Libro();
        $listaLibros = $libros->cargarLibros();

        return response()->json($listaLibros);
    }
    public function cargarCarrito(){
        $carrito = session('carrito', []);
        return response()->json($carrito);
    }
    public function anadirLibros(Request $request){
    $isbn = $request->input('isbn');
    $cantidad = $request->input('cantidad');

    $libroModel = new Libro();
    $libroInfo = $libroModel->cargarLibroPorISBN($isbn);

    if ($libroInfo) {
        $carrito = session('carrito', []);

        if (isset($carrito[$isbn])) {
            $carrito[$isbn]['cantidad'] += $cantidad;
        } else {
            $carrito[$isbn] = [
                'isbn' => $libroInfo->getIsbn(),
                'titulo' => $libroInfo->getTitulo(),
                'escritores'=>$libroInfo->getEscritores(),
                'genero'=>$libroInfo->getGenero(),
                'paginas'=>$libroInfo->getNumpaginas(),
                'imagen'=>$libroInfo->getImagen(),
                'cantidad' => $cantidad,
            ];
        }

        session(['carrito' => $carrito]);

        return response()->json(['mensaje' => 'Libro añadido al carrito']);
    } else {
        return response()->json(['mensaje' => 'Libro no encontrado por ISBN'], 404);
    }
    }

    public function eliminarLibros(Request $request){
        $isbn = $request->input('isbn');
        $cantidad = $request->input('cantidad');

        $carrito = session('carrito', []);

        if (isset($carrito[$isbn])) {

            $carrito[$isbn]['cantidad'] -= intval($cantidad);

            if ($carrito[$isbn]['cantidad'] <= 0) {
                unset($carrito[$isbn]);
            }

            session(['carrito' => $carrito]);

            return response()->json(['mensaje' => 'Libro eliminado del carrito']);
        } else {
            return response()->json(['mensaje' => 'Libro no encontrado por ISBN en el carrito'], 404);
        }
    }

    public function procesarPedido(){
        $carrito = session('carrito', []);
        echo "true";
    }

}

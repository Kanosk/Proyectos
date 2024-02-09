<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('index');
});

//rutas de inicio de sesión, cierre de sesión y verificacion de sesion
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/logout', [UsuarioController::class, 'logout']);
Route::get('/check-session', [UsuarioController::class, 'checkSession']);

//ruta para las funciones de categorias
Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');
Route::post('categoria/store', [CategoriaController::class, 'store'])->name('categoria.store');
Route::put('categoria/update/{idusuario}', [CategoriaController::class, 'update'])->name('categoria.edit');
Route::delete('categoria/delete/{idusuario}', [CategoriaController::class, 'destroy'])->name('categoria.delete');
Route::get('categoria/show/{id}', [CategoriaController::class, 'show'])->name('categoria.show');

//ruta para las funciones de productos
Route::get('producto/{id_cat}', [ProductoController::class, 'index'])->name('producto.index');
Route::delete('producto/delete/{id}', [ProductoController::class, 'destroy'])->name('producto.delete');
Route::post('producto/store', [ProductoController::class, 'store'])->name('producto.store');

//ruta para las funciones de carrito
Route::get('carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::put('carrito/delete/{id}/{cantidad}', [CarritoController::class, 'destroy'])->name('carrito.delete');
Route::post('carrito/store/{id}/{cantidad}', [CarritoController::class, 'store'])->name('carrito.store');

//ruta para la funcion de pedido
Route::get('procesar', [PedidoController::class, 'completarPedido'])->name('carrito.completarPedido');

//

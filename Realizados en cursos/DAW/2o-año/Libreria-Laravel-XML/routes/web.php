<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::match(['get', 'post'], '/', [UsuarioController::class, 'login']);
// Route::match(['get', 'post'], 'principal', [UsuarioController::class, 'iniciarSesion'])->name('principal');
Route::post('cerrarsesion', [UsuarioController::class, 'cerrarsesion'])->name('cerrarSesion');
Route::post('/logout', [UsuarioController::class, 'cerrarSesionAjax']);
Route::get('principal', [UsuarioController::class, 'principal']);
Route::get('/principal', function(){return view('principal');});
Route::get('/procesarPedido', function(){return view('procesarPedido');});
Route::post('principal', [UsuarioController::class, 'iniciarSesion']);

Route::get('listarGeneros', [GeneroController::class, 'listarGeneros'])->name('listarGeneros');

Route::get('libros',[LibroController::class,'cargarLibros'])->name('libros');
Route::get('librosporgenero/{genero}', [LibroController::class, 'cargarLibrosPorGenero']);

Route::get('/cargarLibros', [CarritoController::class, 'cargarLibros']);
Route::post('/anadirLibros', [CarritoController::class, 'anadirLibros']);
Route::post('/eliminarLibros', [CarritoController::class, 'eliminarLibros']);
Route::get('/cargarCarrito', [CarritoController::class, 'cargarCarrito']);




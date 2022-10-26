<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\PublicacionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/publicacion', [PublicacionController::class, 'index'])->name('publicaciones');
Route::get('/publicacion/formulario', [PublicacionController::class, 'insertarVista'])->name('publicar');
Route::post('/publicacion/formulario/insertar', [PublicacionController::class, 'insertar'])->name('publicar.insertar');
Route::get('/publicacion/actualizar/{id}', [PublicacionController::class, 'actualizarVista'])->name('actualizar');
Route::get('/publicacion/borrar/{id}', [PublicacionController::class, 'borrar'])->name('publicar.borrar');

Route::get('/categoria', [CategoriasController::class, 'index'])->name('categorias');
Route::get('/categoria/formulario', [CategoriasController::class, 'insertar'])->name('categoria.nueva');

Route::get('/categoria/actualizar/{id}', [CategoriasController::class, 'categoriaActualizar'])->name('categoriaActualizar');
Route::post('/categoria/modificacion/{id}', [CategoriasController::class, 'actualizar'])->name('agregar.actualizar');
Route::get('/publicacion/borrar/{id}', [PublicacionController::class, 'borrar'])->name('publicar.borrar');

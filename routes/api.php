<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//http://localhost:8000/api/test
Route::get("/test",function(){
    return \App\Models\State::all();
});

//rutas de estados

Route::get("/states",[\App\Http\Controllers\StateController::class,'index']); //get(ruta,funcion[]) la funcion en este caso es la clase y una de sus funciones
Route::get("/states/{state}",[\App\Http\Controllers\StateController::class,'show']); // donde state es el id
Route::get("/states/{state}",[\App\Http\Controllers\StateController::class,'indexFiltered']);
Route::delete("/states/{state}",[\App\Http\Controllers\StateController::class,'destroy']);
Route::post("/states",[\App\Http\Controllers\StateController::class,'store']);
Route::put("/states/{state}",[\App\Http\Controllers\StateController::class,'update']);
Route::put('set_imagen/{id}', [App\Http\Controllers\StateController::class, 'setImagen'])->name('set_imagen');

//rutas de usuario

Route::apiResource('users', App\Http\Controllers\UserController::class);
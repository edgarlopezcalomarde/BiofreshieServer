<?php

use App\Http\Controllers\CosmeticoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;


use Illuminate\Support\Facades\Route;


Route::apiResource('cosmeticos', CosmeticoController::class);
Route::apiResource('categorias', CategoriaController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:api']], function (){
    Route::post('logout', [AuthController::class, 'logOut']);

    Route::apiResource('pedidos', CarritoController::class);

    Route::get('pedidos/userid/{id}', [CarritoController::class, 'searchByUserId']);
    Route::get('pedidos/cartid/{id}', [CarritoController::class, 'searchByCartId']);
});

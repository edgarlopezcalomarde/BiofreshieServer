<?php

use App\Http\Controllers\CosmeticoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\LoginController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;


Route::apiResource('cosmeticos', CosmeticoController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('pedidos', CarritoController::class);

Route::get('pedidos/userid/{id}', [CarritoController::class, 'searchByUserId']);
Route::get('pedidos/cartid/{id}', [CarritoController::class, 'searchByCartId']);

Route::post('register', [LoginController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

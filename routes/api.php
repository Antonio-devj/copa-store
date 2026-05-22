<?php

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rota pública da API para listar produtos (qualquer sistema ou app pode consumir)
Route::get('/produtos', [ProductApiController::class, 'index']);

// Exemplo de rota protegida pelo Sanctum (exige Token de autenticação)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[LoginController::class, 'login']);

Route::post('gastos', [GastoController::class, 'list']); // lista todos
Route::get('gasto/{id}', [GastoController::class, 'index']); // uno por id
Route::post('gasto/nuevo', [GastoController::class, 'store']); // crear
Route::post('gasto/editar', [GastoController::class, 'update']); // editar
Route::post('gasto/eliminar', [GastoController::class, 'destroy']); // eliminar

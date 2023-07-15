<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;



# LISTA DE CLIENTES
Route::get('/', [ClientesController::class, 'home_view']);


#INSERT CLIENTE
Route::post('/cliente/INSERT2312312', [ClientesController::class, 'cliente_insert']);


#UPDATE CLIENTE
Route::post('/cliente/UPDTCLIENTE2312312', [ClientesController::class, 'cliente_update']);


#DELETE CLIENTE
Route::get('/cliente/DELTASK2312312/{id}', [ClientesController::class, 'cliente_delete']);
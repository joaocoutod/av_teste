<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;


Route::get('/', [ClientesController::class, 'home_view']);

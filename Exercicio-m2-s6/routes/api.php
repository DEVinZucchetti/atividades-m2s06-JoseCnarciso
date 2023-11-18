<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;

Route::get('pessoas', [PessoaController::class, 'index']);
Route::post('pessoas', [PessoaController::class, 'store']);
Route::get('pessoas/{id}', [PessoaController::class, 'show']);
Route::delete('pessoas/{id}', [PessoaController::class, 'destroy']);
Route::put('pessoas/{id}', [PessoaController::class, 'update']);



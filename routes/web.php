<?php

use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;



Route::post('/cliente/{id}/pix', [TransacaoController::class, 'fazPix'])->withoutMiddleware(['web', 'csrf']);
Route::get('/transacao', [TransacaoController::class, 'listarTransacoes']);
// --
Route::get('/usuarios', [UsuarioController::class, 'getAllUsers']);
Route::post( '/usuario/criar', [UsuarioController::class, 'criarUsuario'])->withoutMiddleware(['web', 'csrf']);


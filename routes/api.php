<?php

use App\Http\Controllers\ConsolesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['sucesso' => true]);
});

Route::get('/consoles', [ConsolesController::class, 'index']);
Route::get('/consoles/{codigo}', [ConsolesController::class, 'show']);

Route::post('/consoles', [ConsolesController::class, 'store']);
Route::put('/consoles/{id}', [ConsolesController::class, 'update']);
Route::delete('/consoles/{id}', [ConsolesController::class, 'destroy']);

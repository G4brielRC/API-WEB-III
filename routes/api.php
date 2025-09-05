<?php

use App\Http\Controller\ConsolesControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//rotas para visualizar os registros
Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/Consoles', [ConsolesController::class,'show']);
Route::get('/Consoles/{codigo}',[ConsolesController::class,'store']);

//rota para alterar os registros 
Route::post('/Consoles',[ConsolesController::class,'update']);

//rota para excluiir o registro por id/codigo
Route::delete('/Consoles/{id}', [ConsolesController::class,'destroy']);



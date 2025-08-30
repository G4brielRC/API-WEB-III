<?php

use App\Http\Controller\ProdutosControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//rotas para visualizar os registros
Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/produtos', [ProdutosController::class,'show']);
Route::get('/produtos/{codigo}',[ProdutosController::class,'store']);

//rota para alterar os registros 
Route::post('/produtos',[ProdutosController::class,'update']);

//rota para excluiir o registro por id/codigo
Route::delete('/produtos/{id}', [ProdutosController::class,'destroy']);


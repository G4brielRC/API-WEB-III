<?php

namespace App\Http\Controllers;

use App\Models\Consoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ConsolesController extends Controller
{
    /**
     * Listar todos os consoles
     */
    public function index()
    {
        $registros = Consoles::all();
        $contador = $registros->count();

        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Produtos encontrados com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Nenhum produto encontrado.'
        ], 404);
    }

    /**
     * Cadastrar novo produto
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome'  => 'required',
            'marca' => 'required',
            'preco' => 'required|numeric',
            'ano' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors'  => $validator->errors()
            ], 400);
        }

        $console = Consoles::create($request->all());

        if ($console) {
            return response()->json([
                'success' => true,
                'message' => 'Console cadastrado com sucesso!',
                'data'    => $console
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao cadastrar o produto'
        ], 500);
    }

    /**
     * Mostrar produto pelo ID
     */
    public function show($id)
    {
        $console = Consoles::find($id);

        if ($console) {
            return response()->json([
                'success' => true,
                'message' => 'Console localizado com sucesso!',
                'data'    => $console
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produto não encontrado'
        ], 404);
    }

    /**
     * Atualizar produto
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome'  => 'required',
            'marca' => 'required',
            'preco' => 'required|numeric',
            'ano' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors'  => $validator->errors()
            ], 400);
        }

        $console = Consoles::find($id);

        if (!$console) {
            return response()->json([
                'success' => false,
                'message' => 'Console não encontrado'
            ], 404);
        }

        $console->nome  = $request->nome;
        $console->marca = $request->marca;
        $console->preco = $request->preco;
        $console->ano = $request->ano;

        if ($console->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Console atualizado com sucesso!',
                'data'    => $console
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar o produto'
        ], 500);
    }

    /**
     * Deletar produto
     */
    public function destroy($id)
    {
        $console = Consoles::find($id);

        if (!$console) {
            return response()->json([
                'success' => false,
                'message' => 'Console não encontrado'
            ], 404);
        }

        if ($console->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Console deletado com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar o produto'
        ], 500);
    }
}

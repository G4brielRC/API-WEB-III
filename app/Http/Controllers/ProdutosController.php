<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    /**
     * Listar todos os produtos
     */
    public function index()
    {
        $registros = Produtos::all();
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
            'preco' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors'  => $validator->errors()
            ], 400);
        }

        $produto = Produtos::create($request->all());

        if ($produto) {
            return response()->json([
                'success' => true,
                'message' => 'Produto cadastrado com sucesso!',
                'data'    => $produto
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
        $produto = Produtos::find($id);

        if ($produto) {
            return response()->json([
                'success' => true,
                'message' => 'Produto localizado com sucesso!',
                'data'    => $produto
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
            'preco' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors'  => $validator->errors()
            ], 400);
        }

        $produto = Produtos::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não encontrado'
            ], 404);
        }

        $produto->nome  = $request->nome;
        $produto->marca = $request->marca;
        $produto->preco = $request->preco;

        if ($produto->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Produto atualizado com sucesso!',
                'data'    => $produto
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
        $produto = Produtos::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não encontrado'
            ], 404);
        }

        if ($produto->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Produto deletado com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar o produto'
        ], 500);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    public function index()
    {
        /* 
            Retorna TODOS registros do banco de dados
        */
        return response()->json(['erro' => 'O método de solicitação é conhecido pelo servidor, mas foi desativado e não pode ser usado. [e: 405]'], 405);
    }

    public function store(StoreClienteRequest $request) // POST
    {
        /*
            Salva um registro no banco de dados
            Deve ser fornecido: nome, identificacao, data_de_nascimento, classificacao, tipo_alimentacao
        */
        $cliente = Cliente::create($request->all());
        return $cliente;
    }

    public function show(StoreClienteRequest $request) // POST
    {
        /*
            Recupera um registro no banco de dados por meio do ID ou NOME + DATA DE NASCIMENTO.
        */
        $resposta = $request->all();
        if (isset($resposta['identificacao'])) {
            $cliente = Cliente::where('identificacao', '=', $resposta['identificacao'])->first();
            return $cliente ? ['cliente' => $cliente] : response()->json(['erro' => 'Cliente não encontrado pelo Id [e: 404]'], 404);
        } else if (isset($resposta['nome']) and isset($resposta['data_de_nascimento'])) {
            $cliente = Cliente::where('nome', '=', $resposta['nome'])->where('data_de_nascimento', '=', $resposta['data_de_nascimento'])->first();
            return $cliente ? ['cliente' => $cliente] : response()->json(['erro' => 'Cliente não encontrado pelo nome e data de nascimento [e: 404]'], 404);
        } else {
            return response()->json(['erro' => 'Os argumentos passados são inválidos, não foi possível encontrar o cliente [e: 422]'], 422);
        }
    }

    public function update(UpdateClienteRequest $request)
    {
        /*
            Atualiza um registro no banco de dados por meio do ID.
        */
        $resposta = $request->all();
        if (isset($resposta['id'])) {
            $quantidadeAtualizadada = Cliente::where('id', '=', $resposta['id'])->update($resposta);
            return [
                'quantidade_atualizada' => $quantidadeAtualizadada,
            ];
        } else {
            return response()->json(['erro' => 'Os argumentos passados são inválidos ou não foi possível encontrar o cliente pelo Id [e: 404]'], 404);
        }
    }

    public function destroy($id) // GET
    {
        /*
            Deleta um registro no banco de dados por meio do ID.
        */
        $sucesso = Cliente::find($id);
        if ($sucesso) {
            $sucesso->delete();
            return ['id' => $id];
        } else {
            return response()->json(['erro' => 'Não foi possível encontrar o cliente pelo Id  [e: 404]'], 404);
        }
    }
}

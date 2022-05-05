<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use App\Http\Requests\StoreRefeicaoRequest;
use App\Http\Requests\UpdateRefeicaoRequest;

class RefeicaoController extends Controller
{
    public function store(StoreRefeicaoRequest $request)
    {
        /*
            Salva um registro no banco de dados
            Deve ser fornecido: 
                cliente_id,
                data, 
                cafe, 
                almoco, 
                janta, 
                classificacao, 
                tipo_alimentacao, 

        */
        $dadosDaRefeicao = Refeicao::create($request->all());
        return $dadosDaRefeicao;
    }

    public function edit($id, $refeicao, $data)
    {
        return Refeicao::where('cliente_id', '=', $id)->where('data', '=', $data)->update([$refeicao => 2]);
    }

    public function editx($id, $refeicao, $data)
    {
        return Refeicao::where('cliente_id', '=', $id)->where('data', '=', $data)->update([$refeicao => 3]);
    }

    public function show($id, $data)
    {
        return Refeicao::where('cliente_id', '=', $id)->where('data', '=', $data)->first();
    }
}

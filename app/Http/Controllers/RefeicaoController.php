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
        Refeicao::where('id', '=', $id)->update(['consumido' => 1]);
        return [
            'id' => $id,
            'refeicao' => $refeicao,
        ];
    }
}

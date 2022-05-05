<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use App\Models\Cliente;
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

    public function estatisticas($ano, $hoje)
    {
        // REFEIÇÕES
        $jan = Refeicao::where('data', '>=', $ano . '-01-01')->where('data', '<=', $ano . '-01-31')->get();
        $fev = Refeicao::where('data', '>=', $ano . '-02-01')->where('data', '<=', $ano . '-02-29')->get();
        $mar = Refeicao::where('data', '>=', $ano . '-03-01')->where('data', '<=', $ano . '-03-31')->get();
        $abr = Refeicao::where('data', '>=', $ano . '-04-01')->where('data', '<=', $ano . '-04-30')->get();
        $mai = Refeicao::where('data', '>=', $ano . '-05-01')->where('data', '<=', $ano . '-05-31')->get();
        $jun = Refeicao::where('data', '>=', $ano . '-06-01')->where('data', '<=', $ano . '-06-30')->get();
        $jul = Refeicao::where('data', '>=', $ano . '-07-01')->where('data', '<=', $ano . '-07-31')->get();
        $ago = Refeicao::where('data', '>=', $ano . '-08-01')->where('data', '<=', $ano . '-08-31')->get();
        $set = Refeicao::where('data', '>=', $ano . '-09-01')->where('data', '<=', $ano . '-09-30')->get();
        $out = Refeicao::where('data', '>=', $ano . '-10-01')->where('data', '<=', $ano . '-10-31')->get();
        $nov = Refeicao::where('data', '>=', $ano . '-11-01')->where('data', '<=', $ano . '-11-30')->get();
        $dez = Refeicao::where('data', '>=', $ano . '-12-01')->where('data', '<=', $ano . '-12-31')->get();

        $porMes = [
            'jan' => count($jan),
            'fev' => count($fev),
            'mar' => count($mar),
            'abr' => count($abr),
            'mai' => count($mai),
            'jun' => count($jun),
            'jul' => count($jul),
            'ago' => count($ago),
            'set' => count($set),
            'out' => count($out),
            'nov' => count($nov),
            'dez' => count($dez),
        ];

        $total = count($jan) + count($fev) + count($mar) + count($abr) + count($mai) + count($jun) + count($jul) + count($ago) + count($set) + count($out) + count($nov) + count($dez);
        $refeicoesHoje = Refeicao::where('data', '=', $hoje)->where('cafe', '<>', 0)->where('almoco', '<>', 0)->where('janta', '<>', 0)->get();

        // CLIENTES
        $totalClientes = count(Cliente::where('id', '>=', 1)->get());
        $totalClientes_normal = count(Cliente::where('classificacao', '=', 'normal')->get());
        $totalClientes_apoio = count(Cliente::where('classificacao', '=', 'apoio')->get());
        $totalClientes_criancasate1 = count(Cliente::where('classificacao', '=', 'criancasate1')->get());
        $totalClientes_criancasde1a12 = count(Cliente::where('classificacao', '=', 'criancasde1a12')->get());
        $totalClientes_indigena = count(Cliente::where('classificacao', '=', 'indigena')->get());

        return [
            'refeicoes' => [
                'mes' => $porMes,
                'total' => $total,
                'hoje' => $refeicoesHoje,
            ],
            'clientes' => [
                'total' => $totalClientes,
                'tipo_normal' => $totalClientes_normal,
                'tipo_apoio' => $totalClientes_apoio,
                'tipo_criancasate1' => $totalClientes_criancasate1,
                'tipo_criancasde1a12' => $totalClientes_criancasde1a12,
                'tipo_indigena' => $totalClientes_indigena,
            ]
        ];
    }
}

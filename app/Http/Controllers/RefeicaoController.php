<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use App\Models\Cliente;
use App\Http\Requests\StoreRefeicaoRequest;
use App\Http\Requests\UpdateRefeicaoRequest;
use Illuminate\Support\Facades\DB;

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
        $resposta = $request->all();
        $usuarioCheck = Cliente::where('id', '=', $resposta['cliente_id'])->get();
        if (count($usuarioCheck) == 0) {
            return response()->json(['erro' => 'As regras de integridade do banco de dados foram quebradas, o usário que você está tentando relacionar à refeição não existe.'], 404);
        } else {
            $refeicaoCheck = Refeicao::where('cliente_id', '=', $resposta['cliente_id'])->where('data', '=', $resposta['data'])->get();
            if (count($refeicaoCheck) == 0) {
                $dadosDaRefeicao = Refeicao::create($request->all());
                return $dadosDaRefeicao;
            } else {
                return response()->json(['erro' => 'Já existe uma refeição cadastrada para esse usuário na data solicitada.'], 404);
            }
        };
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

    public function estatisticas($ano)
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

    public function relatorio_geral()
    {
        /*
            Retorna todos os registros de refeições
        */
        return Refeicao::all([
            'data',
            'cafe',
            'almoco',
            'janta',
            'classificacao',
            'tipo_alimentacao'
        ]);
    }

    public function relatorio_nominal_data($data)
    {
        $refeicoes = DB::table('refeicoes')
            ->leftJoin('clientes', 'clientes.id', '=', 'refeicoes.cliente_id')
            ->where('refeicoes.data', '=', $data)
            ->get([
                'clientes.nome',
                'clientes.identificacao',
                'refeicoes.classificacao',
                'refeicoes.data',
                'refeicoes.cafe',
                'refeicoes.almoco',
                'refeicoes.janta',
                'refeicoes.tipo_alimentacao',
                'clientes.observacoes',
            ]);
        return $refeicoes;
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('cliente', 'App\Http\Controllers\ClienteController@store');
Route::post('cliente/procurar', 'App\Http\Controllers\ClienteController@show');
Route::post('cliente/atualizar', 'App\Http\Controllers\ClienteController@update');
Route::get('cliente/deletar/{id}', 'App\Http\Controllers\ClienteController@destroy');

Route::post('refeicao/solicitar', 'App\Http\Controllers\RefeicaoController@store');
Route::get('refeicao/consumo/registrar/{id}/{refeicao}/{data}', 'App\Http\Controllers\RefeicaoController@edit');
Route::get('refeicao/consumo/registrarx/{id}/{refeicao}/{data}', 'App\Http\Controllers\RefeicaoController@editx');
Route::get('refeicao/consumo/procurar/{id}/{data}', 'App\Http\Controllers\RefeicaoController@show');

Route::get('estatisticas/{ano}/{hoje}', 'App\Http\Controllers\RefeicaoController@estatisticas');

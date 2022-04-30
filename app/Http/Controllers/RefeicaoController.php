<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use App\Http\Requests\StoreRefeicaoRequest;
use App\Http\Requests\UpdateRefeicaoRequest;

class RefeicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRefeicaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRefeicaoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function show(Refeicao $refeicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Refeicao $refeicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRefeicaoRequest  $request
     * @param  \App\Models\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRefeicaoRequest $request, Refeicao $refeicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Refeicao  $refeicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refeicao $refeicao)
    {
        //
    }
}

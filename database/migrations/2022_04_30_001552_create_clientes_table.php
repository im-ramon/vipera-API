<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 128);
            $table->string('identificacao', 64)->unique();
            $table->date('data_de_nascimento');
            $table->string('classificacao', 128);
            $table->string('tipo_alimentacao', 256);
            $table->string('observacoes', 256)->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}

/*
nome
identificacao
data_de_nascimento
classificacao
tipo_alimentacao
observacoes
*/

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefeicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refeicoes', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('cliente_id');
            $table->integer('cliente_id');
            $table->date('data');
            $table->string('horario', 1);
            $table->string('tipo', 128);
            $table->string('consumido', 1);
            $table->timestamps();

            // $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refeicaos');
    }
}

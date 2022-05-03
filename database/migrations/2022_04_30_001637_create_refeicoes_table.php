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
            $table->string('cafe', 2);
            $table->string('almoco', 2);
            $table->string('janta', 2);
            $table->string('classificacao', 128);
            $table->string('tipo_alimentacao', 128);
            $table->timestamps();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArteCulturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arte_culturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_evento');
            $table->date('data_evento');
            $table->time('hora_evento');
            $table->string('imagem_evento');
            $table->longText('descricao_evento');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('arte_culturas');
    }
}

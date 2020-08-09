<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciaComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncia_comentarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_noticia')->unsigned();
            $table->bigInteger('id_comentario')->unsigned();
            $table->foreign('id_noticia')->references('id')->on('noticias');
            $table->foreign('id_comentario')->references('id')->on('comments');
            $table->string('nome_user_denuncia');
            $table->string('email_user_denuncia');
            $table->string('denuncia');
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
        Schema::dropIfExists('denuncia_comentarios');
    }
}

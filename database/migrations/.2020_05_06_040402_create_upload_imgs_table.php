<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_imagem');
            $table->bigInteger('id_noticia')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_noticia')->references('id')->on('noticias');
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
        Schema::dropIfExists('upload_imgs');
    }
}

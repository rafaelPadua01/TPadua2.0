<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_video');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_noticia')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_noticia')->references('id')->on('noticias');
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
        Schema::dropIfExists('upload_videos');
    }
}

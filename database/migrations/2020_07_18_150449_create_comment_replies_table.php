<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('id_noticia')->unsigned();
            $table->biginteger('id_comentario')->unsigned();
            $table->foreign('id_noticia')->references('id')->on('noticias');
            $table->foreign('id_comentario')->references('id')->on('comments');
            $table->string('nome_user_coment_reply');
            $table->string('email_user_coment_reply');
            $table->longText('content_coment_reply');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_replies');
    }
}

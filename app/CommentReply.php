<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //
    protected $fillable = ['id_noticia', 'id_comentario', 'nome_user_coment_reply', 'email_user_coment_reply', 'content_coment_reply'];
}

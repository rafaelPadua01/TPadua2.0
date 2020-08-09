<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $fillable = ['id_noticia', 'nome_user_coment', 'content_coment', 'email_user_coment'];
}

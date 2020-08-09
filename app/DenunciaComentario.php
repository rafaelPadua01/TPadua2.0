<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DenunciaComentario extends Model
{
    //
    protected $fillable = ['id_noticia', 'id_comentario', 'nome_user_denuncia', 'email_user_denuncia', 'denuncia'];
}

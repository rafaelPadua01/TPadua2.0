<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DenunciaReply extends Model
{
    //
    protected $fillable = ['id_resposta', 'email_user_denuncia_reply', 'denuncia'];
}

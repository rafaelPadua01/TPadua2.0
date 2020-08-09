<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArteCultura extends Model
{
    //
    protected $fillable = ['id','id_user', 'nome_evento', 'data_evento', 'hora_evento', 'imagem_evento', 'file', 'descricao_evento'];
}

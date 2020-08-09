<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadImg extends Model
{
    protected $fillable = ['id','id_user','id_noticia', 'nome_imagem'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadGaleria extends Model
{
    protected $fillable = ['id_noticia', 'id_user', 'nome_galeria', 'nome_imagem'];
}

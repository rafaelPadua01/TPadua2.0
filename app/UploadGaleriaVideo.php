<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadGaleriaVideo extends Model
{
    //
    protected $fillable = ['id', 'id_user', 'id_noticia', 'nome_galeria', 'nome_video'];
}

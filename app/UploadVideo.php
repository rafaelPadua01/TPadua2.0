<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadVideo extends Model
{
    //
    protected $fillable = ['id_noticia', 'id_user', 'nome_video']; 
}

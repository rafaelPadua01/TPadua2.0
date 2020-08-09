<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    //
    protected $fillable = [
        'id_categoria',
		'id_user',
		'titulo',
		'content',
		'fonte',
		'destaque',
    ];
}

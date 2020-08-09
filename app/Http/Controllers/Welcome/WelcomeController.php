<?php
namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Noticias;
use App\Categorias;
use App\ArteCultura;
use App\UploadImg;


class WelcomeController extends Controller
{
    public function index()
    {
        $n_destaque = Noticias::where('destaque', '=', 1)->orderBy('id', 'desc')->limit(1)->get();
        $f_noticias = Noticias::orderBy('id', 'desc')->get();
        $u_noticias = Noticias::orderBy('id', 'desc')->limit(4)->get();
        $categorias = Categorias::orderBy('id')->limit(4)->get();
        $eventos = ArteCultura::orderBy('id', 'desc')->limit(5)->get();
        $upload_img = UploadImg::all();
        

        foreach($categorias as $categoria)
        {
            $id_categoria = $categoria->id;
             $s_noticia = Noticias::where('id_categoria', '=', $id_categoria)->get();
            return view('welcome', compact('n_destaque', 'f_noticias', 'u_noticias', 'categorias', 's_noticia',
                        'eventos', 'upload_img'))
            ->with(json_encode($n_destaque), json_encode($f_noticias), json_encode($u_noticias),
                    json_encode($categorias), json_encode($s_noticia), json_encode($eventos),
                    json_encode($upload_img));
        }
        return view('welcome', compact('n_destaque', 'f_noticias', 'u_noticias', 'categorias',))
                ->with(json_encode($n_destaque), json_encode($f_noticias), json_encode($u_noticias), json_encode($categorias));
    }

}
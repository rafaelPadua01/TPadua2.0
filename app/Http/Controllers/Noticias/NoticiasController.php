<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Noticias;
use App\Categorias;
use App\User;
use App\UploadImg;
use App\Comments;
use App\CommentReply;

class NoticiasController extends Controller
{
    private $noticias;

    public function __construct(Noticias $noticias)
    {
        //A classe só poderá ser acessada por usuarios autenticados
        //$this->middleware('auth'); 
        //Recebe as noticias
        $this->noticias = $noticias;
    }

    public function index()
    {
        $noticias = Noticias::orderBy('id', 'desc')->get();
        $categorias = Categorias::all();
        $user = \Auth::user();
        return view('noticias.index', compact('noticias', 'categorias', 'user'))
                ->with(json_encode($noticias), json_encode($categorias), json_encode($user));
    }
    public function create(Request $request)
    {
       $data = $request->all();
       $r_noticia = $data;
       try{
           if($r_noticia !== 'null')
           {
               $noticia = Noticias::create($data);
               broadcast(new \App\Events\SendNoticia($noticia));
               return \Response::json($data); 
           }
           else
           {
               return $error;
           }
       }
       catch(Exception $e)
       {
           $error = $e;
           return $error;
       }
       
       //return \Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
      
      
        if($data !== null)
        {
            try{
                $updateNoticia = Noticias::findOrFail($id)->update($data);
                return \Response::json($data);
            }
            catch(Exception $e)
            {
                $error = $e;
                return $error;
            }
        }
        //return \Response::json($data);
    }
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        if($data !== 'null')
        {
            try{
                $noticiasDelete = Noticias::findOrFail($id)->where('id', '=', $id)->delete();
                return \Response::json($data);
            }
            catch(Exception $e)
            {
                $error = $e;
                return \Response::json($error);
            }
        }
        
    }
    public function show($id){
        $noticia = Noticias::findOrFail($id);
        $img = UploadImg::where('id_noticia', '=', $id)->get();
        $comentarios = Comments::where('id_noticia', '=', $id)->orderBy('id', 'desc')->get();
        $respostas = CommentReply::orderBy('id', 'desc')->get();
        return view('noticias.show', compact('noticia', 'img', 'comentarios', 'respostas'))
                ->with(json_encode($noticia), json_encode($img), json_encode($comentarios), json_encode($respostas));
    }

    public function lastNews()
    {
        $last_news = Noticias::orderBy('id', 'desc')->limit(4)->get();
        $categorias = Categorias::all();
        return view('noticias.last', compact('last_news', 'categorias'))
            ->with(json_encode($last_news), json_encode($categorias));
    }

}

<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comments;
use App\Noticias;

class ComentariosController extends Controller
{
    private $comments;

    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    public function index()
    {

    }

    public function store(Request $request, $id)
    {
        $noticia = Noticias::findOrFail($id);
        $data = $request->all();

        try{
            $insertComment = Comments::create([
                'id_noticia' => $id,
                'nome_user_coment' => $request->nome_user_coment,
                'email_user_coment' => $request->email_user_coment,
                'content_coment' => $request->content_coment,
            ]);
            if($insertComment)
            {
                $response = true;
                return \Response::json($response);
            }
           
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
        
    }
}
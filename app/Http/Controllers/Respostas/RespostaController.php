<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CommentReply;
use App\Comments;
use App\User;
use App\Noticias;

class RespostaController extends Controller
{
    private $resposta;
    
    public function __construct(CommentReply $resposta)
    {
        $this->resposta = $resposta;
    }
    public function store(Request $request, $id)
    {
        $comentario = Comments::findOrFail($id);
        $id_noticia = $comentario->id_noticia;
       
       
        
        try{
            $insert_reply = CommentReply::create([
                'id_noticia' => $id_noticia,
                'id_comentario' => $id,
                'nome_user_coment_reply' => $request->nome_user_coment_reply,
                'email_user_coment_reply' => $request->email_user_coment_reply,
                'content_coment_reply' =>$request->content_coment_reply,
            ]);

            if($insert_reply)
            {
                $resposta = $insert_reply;
                $noticia = Noticias::where('id', '=', $id_noticia);
                $user = User::where('id', '=', $noticia->id_user);
                

                foreach($users as $user)
                {
                    if($user->id == $noticia->id_user)
                    {
                        $user->notify(new NotificaResposta($resposta));
                    }
                }

                $response = true;
                return \Response::json($response);
            }
        }
        catch(Exception $e){
            $errror = $e;
            return \Reponse::json($error);
        }
    }

    public function destroy(Request $request, $id)
    {
        $email_user_coment_reply = $request->email_user_reply;
        $resposta = Commentreply::findOrFail($id);
        if($resposta->email_user_coment_reply == $email_user_coment_reply)
        {
            try{
                $delete_reposta = CommentReply::where('email_user_coment_reply', '=', $email_user_coment_reply)->delete();
                $response = true;
                return \Response::json($response);
            }
            catch(Exception $e)
            {
                $error = $e;
                return \Response::json($error);
            }
        }
    }
    public function destroyadmin($id)
    {
        try{
            $destroy_resp = CommentReply::findOrFail($id)->delete();
            $response = true;
            return \Response::json($response);
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Reponse::json($error);
        }
    }

}
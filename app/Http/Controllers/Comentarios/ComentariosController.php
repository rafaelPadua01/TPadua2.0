<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comments;
use App\CommentReply;
use App\Noticias;
use App\User;
use App\DenunciaComentario;
use App\DenunciaReply;
use App\Notifications\NotificaComentario;

class ComentariosController extends Controller
{
    private $comentario;
   

    public function __construct(Comments $comentario)
    {
       // $this->middleware('auth');
        $this->comentario = $comentario;
       

    }

    public function index()
    {
        $user = \Auth::user();
        $comentarios = Comments::all();
        $respostas = CommentReply::all();
        $denuncia = DenunciaComentario::all();
        $denuncia_r = DenunciaReply::all();
        return view('comentarios.index', compact('user', 'comentarios', 'respostas', 'denuncia', 'denuncia_r'))
                    ->with(json_encode($comentarios), json_encode($respostas), json_encode($user), json_encode($denuncia), 
                        json_decode($denuncia_r));
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
               $comentario = $insertComment;
                // Recebe o usuario logado e envia um email de notificação de novo comentario
                //$comentario = $data;
                $users = User::all();
                foreach($users as $user)
                {
                    if($user->id == $noticia->id_user)
                    {
                        $user->notify(new NotificaComentario($comentario));
                    }
                }
                $response = true;
                return \Response::json($response);
                
            }
           
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
        
    }
    public function destroy(Request $request, $id){
        $comentario = Comments::findOrFail($id);
        $email_user = $request->email_user_coment;
        //dd($comentario->email_user_coment, $email_user);

       
            try{
                $destroy_resp = CommentReply::where('id_comentario', '=', $id)->delete();
                $destroy = Comments::findOrFail($id)->where('email_user_coment', '=', $email_user)->delete();
                $response = true;
                
                return \Response::json($response);
                
            }
            catch(Exception $e)
            {
                $error = $e;
                return \Reponse::json($error);
            }
        
    }
    public function destroyadmin($id){
        $comentario = Comments::findOrFail($id);
        //$email_user = $request->email_user_coment;
        //dd($comentario->email_user_coment, $email_user);

       
            try{
                $destroy_resp = CommentReply::where('id_comentario', '=', $id)->delete();
                //$destroy_denuncia = DenunciaComentario::where('id_comentario', '=', $id)->delete();
                $destroy = Comments::findOrFail($id)->delete();
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
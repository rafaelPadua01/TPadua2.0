<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DenunciaComentario;
use App\Comments;


class DenunciaComentariosController extends Controller
{
    private $denuncia;

    public function __construct(DenunciaComentario $denuncia)
    {
        $this->denuncia = $denuncia;
    }

    public function store(Request $request, $id)
    {
        $comentarios = Comments::findOrFail($id);
        $id_noticia = $comentarios->id_noticia;
        $denuncia = implode('denuncia', $request);
     
        try{
            $create_denuncia = DenunciaComentario::create([
                'id_noticia' => $id_noticia,
                'id_comentario' => $id,
                'nome_user_denuncia' => $request->nome_user_denuncia,
                'email_user_denuncia' => $request->email_user_denuncia,
                'denuncia' => $denuncia,
            ]);

            if($create)
            {
                $response = true;
                return \Response::json($reponse);
            }
        }catch(Exception $e){
            $error = $e;
            return \Reponse::json($error);
        }
        

    }

    public function destroy($id)
    {
        try{
            $denuncia = DenunciaComentario::findOrFail($id)->delete();
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
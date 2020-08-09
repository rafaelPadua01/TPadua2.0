<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DenunciaReply;
use App\CommentReply;

class DenunciaReplyController extends Controller
{
    private $d_reply;

    public function __construct(DenunciaReply $d_reply)
    {
        $this->reply = $d_reply;
    }

    public function store(Request $request, $id)
    {
        $r_denuncia = CommentReply::findOrFail($id);
        $data = $request->all();

        if($r_denuncia->email_user_coment_reply == $data->email_user_denuncia_reply)
        {
            try{
                $create_denuncia_reply = DenunciaReply::create([
                    'id_reposta' => $id,
                    'email_user_denuncia_reply' => $data,
                    'denuncia' => $data->implode(', ', 'denuncia_reply'),
                ]);

                $reponse = true;
                return \Response::json($response);
            }
            catch(Exception $e)
            {
                $error = $e;
                return \Response::json($error);
            }
        }
    }

    public function destroy($id)
    {
        try{
            $destroy_denuncia = DenunciaReply::findOrFail($id)->delete();
            $response = true;
            return \Response::json($response);
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
    }
}

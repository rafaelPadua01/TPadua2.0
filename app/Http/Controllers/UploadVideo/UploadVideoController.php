<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UploadVideo;
use App\Noticias;
use File;
use Illuminate\Http\Request;
use Illuminate\Suport\Facades\Storage;

class UploadVideoController extends Controller
{
    private $file;
    public function __construct(UploadVideo $file){
        $this->file = $file;
    }
    /*
    public function  index()
    {

    }
    public function show(){

    }
    */
    public function upload(Request $request, $id)
    {
        $noticia = Noticias::findOrFail($id);
        $user = \Auth::user()->id;
        $data  = $request->all();
        $file = $request->file('file');
        $name_file = $noticia->titulo;
        
        if($request->hasfile('file') && $request->file('file')->isValid())
        {
            $path = $request->file('file')->path();
            $extension = $request->file('file')->extension();

            $name = uniqid(date('HisYmd'));

            $nameFile = "noticia.{$name}.mp4";
            $insertDirectory = $request->file->move('storage/video_noticias/'.$name_file, $nameFile);
          
            try{
                 $insertDataBase = UploadVideo::create([
                    'nome_video' =>  $insertDirectory,
                    'id_noticia' => $noticia->id,
                    'id_user' => $user,
                    ]);
                    return \Response::json($data);
                }
                catch(Exception $e)
                {
                    $error = $e;
                    return \Reponse::json($error);
                }
           

        }

        //return \Response::json($data);
    }

    public function destroy(Request $request, $id)
    {
        $video = UploadVideo::findOrFail($id);
        $nome_video = $video->nome_video;

        try{
            $remove_file = FILE::delete($nome_video);

            if($remove_file)
            {
                $remove_db = UploadVideo::where('id', '=', $id)->delete();
                $response = true;
                return \Response::json($response);
            }
            else{
                $error = "erro ao remover arquivo";
                return \Response::json($error);
            }
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
    }

}
<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use App\UploadGaleriaVideo;
use App\Noticias;

class UploadGaleriaVideoController extends Controller
{
    protected $galeria_video;
    public function __construct(UploadGaleriaVideo $galeria_video)
    {
        $this->galeria_video = $galeria_video;
    }
    public function index()
    {

    }
    public function show()
    {

    }
    public function upload(Request $request, $id)
    {
        $noticia = findOrFail($id);
        $user = \Auth::user()->id;
        $data = $request->all();

        dd($noticia, $user, $data);
    }
    public function destroy(Request $request, $id)
    {
        $galeria_video = UploadGaleriaVideo::findOrFail($id);
        $nome_galeria = $request->nome_galeria;

        //Remove o diretorio dos arquivos
        try{
            $dir = 'public/galeria_videos/'.$nome_galeria;
            $destroy_dir = Storage::deleteDirectory($dir);
            //Se o diretorio for removido
            //Remove os dados do banco
            if($destroy_dir)
            {
                $destroy = UploadGaleriaVideo::where('id', '=', $id)->delete();
                $response = true;
                return \Response::json($response);
            }
            else{
                $error = false;
                return \Response::json($error);
            }
        }catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
    }
    public function destroyVideo(Request $request, $id)
    {
        $video_galeria = UploadGaleriaVideo::findOrFail($id);
        $nome_video = $request->nome_video;
        $user = \Auth::user();
        dd($user);

        //remove video do diretorio
        try{
            $destroy_video = File::delete($nome_video);
            
            //Se o arquivo for removido
            //remove da base de dados ... 
            if($destroy_video)
            {
                $destroy = UploadGaleriaVideo::where('nome_video', '=', $nome_video)->delete();
                $response = true;
                return \Response::json($response);
            }
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
}
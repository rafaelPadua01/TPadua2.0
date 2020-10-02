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
        $this->middleware('auth');
    }
    public function index()
    {

    }
    public function show()
    {

    }
    public function upload(Request $request, $id)
    {
        $noticia = Noticias::findOrFail($id);
        $user = \Auth::user()->id;
        $files = $request->file('files');
        $nome_galeria = $noticia->titulo;
       
        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name = uniqid(date('HisYmd'));
                $extension = $file->extension();
                $nameFile = "galeria.{$name}.{$extension}";

                $insertDirectory = $file->move('storage/galeria_videos/'.$nome_galeria, $nameFile);

                $data[] = $name;
                
                if($data)
                {
                    $insertData = UploadGaleriaVideo::create([
                        'nome_galeria' => $nome_galeria,
                        'nome_video' => $insertDirectory,
                        'id_user' => $user,
                        'id_noticia' => $noticia->id,
                    ]);
                }
            }
            return \Response::json($data);
        }
       
       // dd($noticia, $user, $data);
    }
    public function preview($video)
    {
        $nome_galeria = $video;
        $galeria_video = UploadGaleriaVideo::all()->where('nome_galeria', '=', $nome_galeria);
        $user = \Auth::user();

        foreach($galeria_video as $video)
        {
            $videos_galeria = $video;
            return view('galeriaNoticias.video_preview', compact('videos_galeria', 'user'))
                    ->with(json_encode($videos_galeria), json_encode($user));
        }
    }
    public function destroy(Request $request, $id)
    {
        $galeria_video = UploadGaleriaVideo::findOrFail($id);
        $nome_galeria = $galeria_video->nome_galeria;

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
    public function destroy_video(Request $request, $id)
    {
        $video_galeria = UploadGaleriaVideo::findOrFail($id);
        $nome_video = $video_galeria->nome_video;
        $user = \Auth::user();
        
        //remove video do diretorio
        try{
            $destroy_video = File::delete($nome_video);
            
            //Se o arquivo for removido
            //remove da base de dados ... 
            if($destroy_video == true)
            {
                $dir = 'public/galeria_videos/'.$nome_video;
                $destroy_dir = Storage::deleteDirectory($dir);
                $destroy = UploadGaleriaVideo::where('id', '=', $id)->delete();
                $response = true;
                return \Response::json($response);
               
            }
            else{
                $error = false;
                return \Response::json($error);
            }
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
}
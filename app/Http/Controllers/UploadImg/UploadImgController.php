<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use App\Noticias;
use App\UploadImg;
use App\UploadGaleria;
use App\UploadVideo;
use App\UploadGaleriaVideo;
use App\User;

class UploadImgController extends Controller
{
    private $file;

    public function __construct(UploadImg $file)
    {
        $this->file = $file; 
        $this->middleware('auth');
    }
    public function index()
    {
        $images = UploadImg::all();
        $user = \Auth::user();
        $galerias = UploadGaleria::all();
        $videos = UploadVideo::all();
        $galeria_videos = UploadGaleriaVideo::all();
        //$diretorios = public_path('galeria_noticias/');
        $dir_galerias = Storage::allDirectories('public/galeria_noticias/');
        $dir_videos = Storage::allDirectories('public/video_noticias/');
        //$galeria_videos = Storage::allDirectories('public/galeria_videos/');
        $noticias = Noticias::all();

        return view('galeriaNoticias.index', compact('images', 'user', 'galerias','dir_galerias', 'noticias', 
                    'videos', 'dir_videos', 'galeria_videos'))
            ->with(json_encode($images), json_encode($user), json_encode($galerias), json_encode($noticias),
                    json_encode($dir_galerias), json_encode($videos), json_encode($dir_videos), json_encode($galeria_videos));
    }
    public function upload(Request $request, $id)
    {
        $data = $request->all();
        $noticia = Noticias::findOrFail($id);
        $user = \Auth::user()->id;
        $file = $request->file('file');
        
        if($request->hasfile('file') && $request->file('file')->isValid())
        {
            $path = $request->file->path();
            $extension = $request->file->extension();

            $name = uniqid(date('HisYmd'));

            $nameFile = "noticia.{$name}.{$extension}";
            $insertDirectory = $request->file->move('storage/imagem_noticias/', $nameFile);
            
            try{
               $insertDataBase = UploadImg::create([
                   'nome_imagem' => $insertDirectory,
                   'id_noticia' => $noticia->id,
                   'id_user' =>  $user,
               ]);
               return \Response::json($data);
            }
            catch(Exception $e)
            {
                $error = $e;
                return \Response::json($error);
            }
             
            
        }
     return response()->json($data);

    }

    public function store($id, Request $request)
    {
        $noticia = Noticias::findOrFail($id);
        $data = $request->all();
        dd($noticia);
    }

    public function destroy(Request $request, $id)
    {
        $img_id = UploadImg::findOrFail($id);
        $nome_img = $img_id->nome_imagem;
       
        $img = UploadImg::select('nome_imagem')->where('id', '=', $id)->delete();
        //$destroy = UploadImg::findOrFail($id)->where('id', '=', $id)->delete();
       try
           {
            
            $destroy_file = File::delete($nome_img);
            
              if($destroy_file == true)
              {
                $destroy = UploadImg::findOrFail($id)->where('id', '=', $id)->delete();
                $response = true;
                return \Response::json($response);
              }
              else{
                  return \Response::json($error);   
              }
                
           }
        catch(Exception $e)
           {
               $error = $e;
               return \Response::json($e);
           }
          
           
        
    }
}
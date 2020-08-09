<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use File;
use App\UploadGaleria;
use App\Noticias;

class UploadGaleriaController extends Controller
{
    private $galeriaUpload;

    public function __construct(UploadGaleria $galeriaUpload)
    {
        $this->galeriaUpload = $galeriaUpload;
        $this->middleware('auth');
    }

    public function upload(Request $request, $id)
    {
        $noticia = Noticias::findOrFail($id);
        $user = \Auth::user()->id;
        $files = $request->file('files');
        $nome_galeria = $noticia->titulo;
        
       if($request->hasfile('files'))
        {
            
           // $path = Storage::makeDirectory('public/galeria_noticias/'.$nome_galeria);
            foreach($request->file('files') as $file)
            {
                $name = uniqid(date('HisYmd'));
                $extension = $file->extension();
                $nameFile = "galeria.{$name}.{$extension}";
            
                $insertDirectory = $file->move('storage/galeria_noticias/'.$nome_galeria, $nameFile);
                
                $data[] = $name;
                if($data)
                {
                    $insertData = UploadGaleria::create([
                        'nome_galeria' => $nome_galeria,
                        'nome_imagem' => $insertDirectory,
                        'id_user' => $user,
                        'id_noticia' => $noticia->id,
                    ]);
                }
            }
            return \Response::json($data);
        }
    }
    public function preview($galeria)
    {
        $nome_galeria = $galeria;
        $galerias = UploadGaleria::all()->where('nome_galeria', '=', $nome_galeria);
        $user = \Auth::user();

        foreach($galerias as $galeria)
        {
            $imgs_galeria = $galerias;
            return view('galeriaNoticias.preview',compact('imgs_galeria', 'user'))->with(json_encode($imgs_galeria), json_encode($user));
        }
    }
    public function destroy(Request $request, $id)
    {
        $img = UploadGaleria::findOrFail($id);
        $nome_img = $img->nome_imagem;
        
        //tenta remover o arquivo do diretorio
        //se retorna true, tenta remover a linha do banco de dados
        try{
            $destroy_file = File::delete($nome_img);
            //Se o arquivo for deletado do diretorio
            //o programa tenta remover do banco de dados
            if($destroy_file == true)
            {
                $destroy = UploadGaleria::select('*')->where('id', '=', $id)->delete();
                $response = true;
                return \Response::json($response);
            }
            else
            {
                return \Response::json($error);
            }
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($e);
        }
    }
    public function destroy_galeria(Request $request, $nome_galeria)
    {
        $galeria = $nome_galeria;
       
        
        
        try{
            //testa se a linha foi removida do banco de dados
            //retornando true, remove o diretorio que contém o mesmo nome
            if($galeria)
            {
                $diretorio = 'public/galeria_noticias/'.$galeria;
                
                $remove_dir = Storage::deleteDirectory($diretorio);
                
                if($remove_dir)
                {
                    $remove_galeria = UploadGaleria::where('nome_galeria', '=', $nome_galeria)->delete();
                    $response = true;
                    return \Response::json($response);
                }
                else{
                    echo "<script>window.alert('erro')</script>";
                }

            }
            else{
                echo "<script>window.alert('erro')</script>";
            }
        }
        catch(Exception $e){
            $error = $e;
            return \Reponse::json($error);
        }
       
    }
}
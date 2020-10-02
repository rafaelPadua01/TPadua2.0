<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use App\ArteCultura;
use App\Noticias;

class ArteCulturaController extends Controller
{
    private $arteCultura;

    public function __construct(ArteCultura $arteCultura)
    {
        //$this->middleware('auth');
        $this->arteCultura = $arteCultura;
    }
    public function index()
    {
        $user = \Auth::user();
        $arte_cultura = ArteCultura::all();
        return view('arteCultura.index', compact('user', 'arte_cultura'))->with(json_encode($user), json_encode($arte_cultura));
    }
    public function store(Request $request)
    {
        $evento  = $request->all();
        $nome_arquivo = $request->file('file');
        
        if($request->hasFile('file') && $nome_arquivo->isValid())
        {
            //Cria uma variavel path que recebe o camnho originario da imagem
            $path = $nome_arquivo->path();
            //Cria uma variavel que armazena a extensão do arquivo
            $extension = $nome_arquivo->extension();

            //Cria um nome baseado no timestamp do servidor
            $name = uniqid(date('HisYmd'));

            //Cria uma variavel de define o nome final do arquivo com a extensão
            $name_file  = "evento.{$name}.{$extension}";

            //insere a imagem no diretorio
            $insert_directory = $nome_arquivo->move('storage/imagem_eventos/', $name_file);
            //Tenta inserir a imagem com todos os outros valores na tabela

            $data_evento = date('Y-m-d',strtotime($request->data_evento));

            
            try{
                //recebe o insert
                $insert_database = ArteCultura::create([
                    'id_user' => $request->id_user,
                    'nome_evento' => $request->nome_evento,
                    'data_evento' => $request->data_evento,
                    'hora_evento' => $request->hora_evento,
                    'imagem_evento' => $insert_directory,
                    'descricao_evento' => $request->descricao_evento,
                ]);
                
                if($insert_database)
                {
                    $response = true;
                    return \Response::json($response);
                }
            }
            catch(Exception $e){
                $error = $e;
                return \Response::json($error);
            }

            //return \Response::json($response);
            
        }
    }
    public function update(Request $request, $id)
    {
        $update_evento = $request->all();
        //dd($update_evento);
        $evento = ArteCultura::findOrFail($id);
        $nome_imagem = $request->file('file');
        $user = \Auth::user();

        dd($update_evento, $user, $nome_imagem);
       
        
    }
    public function show($id)
    {
        $evento = ArteCultura::findOrFail($id);
        return view('arteCultura.show', compact('evento'))->with(json_encode($evento));

    }

}
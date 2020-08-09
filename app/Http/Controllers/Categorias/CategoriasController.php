<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorias;

class CategoriasController extends Controller
{
    protected $categorias;

    public function __construct(Categorias $categorias)
    {
        $this->middleware('auth');
        $this->categorias = $categorias;
    }

    public function index()
    {
        $categorias = Categorias::all();
        $user = \Auth::user();
        return view('categorias.index', compact('categorias', 'user'))
            ->with(json_encode($categorias), json_encode($user));
    }

    public function create(Request $request)
    {
        $user = \Auth::user()->id;
        $n_categoria = $request->nome_categoria;
        $n_tipo  = $request->nome_categoria;
      
        try{
            $create = Categorias::create([
                'id_user' => $user,
                'nome_categoria' => $n_categoria,
                'tipo' => $n_tipo,

            ]);
            
            if($create)
            {
                $response = true;
                return \Response::json($response);
            }
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
    }

    public function update($id, Request $request)
    {
        $n_categoria = $request->nome_categoria;

        try{
            $update_categoria = Categorias::findOrFail($id)->update([
                'nome_categoria' => $n_categoria,
                'tipo' => $n_categoria,
            ]);

            if($update_categoria){
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

    public function destroy($id)
    {
         try
        {
            $destroy_cat = Categorias::findOrFail($id)->delete();
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

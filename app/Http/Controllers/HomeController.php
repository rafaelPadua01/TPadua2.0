<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\CommentReply;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        $comentarios = Comments::all();
        $respostas = CommentReply::all();
       
        return view('admin.index', compact('user', 'comentarios', 'respostas'))->with(json_encode($user), json_encode($comentarios), json_encode($respostas));
    }
}

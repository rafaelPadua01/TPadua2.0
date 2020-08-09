<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Newsletter;
use App\NewsletterAssing;
use App\NewsletterHistory;
use App\User;
use App\UploadImg;

class NewsletterController extends Controller
{
    protected $newsletter;

    public function __construct(Newsletter $newsletter)
    {
        $this->middleware('auth');
        $this->newsletter = $newsletter;
    }

    public function index()
    {
        $n_users_assing = NewsletterAssing::all();
        $user = \Auth::user();
        $img_noticia = UploadImg::all();
        $history = NewsletterHistory::all();
        return view('newsletter.index', compact('n_users_assing', 'user', 'img_noticia', 'history'))
                ->with(json_encode($n_users_assing), json_encode($user), json_encode($img_noticia), json_encode($history));
    }
    public function assing()
    {
        return view('newsletter.assing');
    }
   

}

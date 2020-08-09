<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsletterAssing;

class NewsletterAssingController extends Controller
{
    private $newsletter_assing;

    public function __construct(NewsletterAssing $newsletter_assing)
    {
        $this->newsletter_assing = $newsletter_assing;
    }

    public function index()
    {
        return view('newsletter.index');
    }

    public function assing_create(Request $request)
    {
        $n_user_data = $request->all();
        try{
            $assing = NewsletterAssing::create($n_user_data);

            if($assing)
            {
                $response = true;
                return \Reponse::json($response);
            }
            
        }catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
        
    }
}
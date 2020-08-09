<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Ilumminate\Http\Resquest;
use App\NewsletterHistory;

class NewsletterHistoryController extends Controller{
    protected $newsletter_h;

    public function __construct(NewsletterHistory $newsletter_h)
    {
        $this->middleware('auth');
        $this->newsletter_h = $newsletter_h;
    }

    public function index()
    {
        $history = NewsletterHistory::all();

        return view('newsletter.index', compact('history'))->with(json_encode($history));
    }

    public function destroy(Request $request, $id)
    {
        $history = NewsletterHistory::findOrFail($id);
        
       try{
            $destroy_history = $history->delete();
            if($destroy_history)
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
}

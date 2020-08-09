<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NewsletterAssing;
use App\Noticias;
use App\Newsletter;
use App\NewsletterHistory;
use App\UploadImg;
use App\ArteCultura;

class NewsletterAssingController extends Controller
{
    private $newsletter_assing;

    public function __construct(NewsletterAssing $newsletter_assing)
    {
        //$this->middleware('auth');
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
                return \Response::json($response);
            }
            
        }catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
        
    }
    public function assing_update(Request $request, $id)
    {
        $n_user = NewsletterAssing::findOrFail($id);
        $n_user_update = $request->all();
        
        try{
            $update = NewsletterAssing::findOrFail($id)->update($n_user_update);
            $response = true;
            return \Response::json($response);
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
    public function assing_destroy($id)
    {
        $destroy_assing = NewsletterAssing::findOrFail($id);

        try{
            $destroy = $destroy_assing->where('id', '=', $id)->delete();
            $response = true;
            return \Response::json($response);
        }catch(Exception $e){
            $error = $e;
            return \Response::json($e);
        }
    }
    public function sendMail(Request $request)
    {
        $emails = $request->email_users;
        $assunto_email = $request->assunto_email;
        $images = UploadImg::findOrFail($request->files_img);
        $noticias = Noticias::all();
        $eventos = ArteCultura::all();
       

      //dd($emails, $assunto_email, $images);

        $mail = \Mail::send('newsletter.mail', 
                ['noticias' => $noticias, 'emails' => $emails, 'assunto_email' => $assunto_email, 'images' => $images,
                                'eventos' => $eventos], 
                    function($message) use ($emails, $assunto_email, $noticias, $images, $eventos){
                        $message->subject($assunto_email);
                        $message->from('rafael.f.p.fariadk@gmail.com', 'Newsletter');  
                        
                        
                        foreach($emails as $email)
                        {
                            try{
                                $n_users = Newsletter::select('*')->from('newsletter_assings')->where('email_user', '=', $email);
                                $message->bcc($email);
                                $response = true;
                                
                                if($response)
                                {
                                    $user = \Auth::user()->id;
                                    $create_history = NewsletterHistory::create([
                                        'id_user' => $user,
                                        'assunto' => $assunto_email,
                                        'destinatarios' => json_encode($emails),
                                    ]);
                                    return \Response::json($response);
                                }
                                else
                                {
                                    echo "<script>window.alert('Erro ao criar o historico')</script>";
                                    return false;
                                }
                                
                                return \Response::json($response);
                            

                            }
                            catch(Exception $e){
                                $error = $e;
                                return \Response::json($error);
                            }
                        
                        }
                    });
        

        
        

        
       
       // dd($n_mail);
    }
}
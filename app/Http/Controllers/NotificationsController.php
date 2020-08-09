<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class NotificationsController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');
    }
    //Exibe todas as notificações 
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications;
        return \Response::json(compact('notifications'));
    }
    //Exibe as notificações não lidas para o usuario
    public function notifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications; //recebe dados do usuario logado
        return \Response::json(compact('notifications'));
    }
    //Atualia o status da notificação para 'lida'
    public function updateNotifications(Request $request)
    {
        $user = auth()->user();
        foreach($user->unreadNotifications as $notifications)
        {
            $notifications = $user->unreadNotifications()->update(['read_at' => now()]);
            return \Response::json(compact('notifications'));
        }
    }

    public function showNotifications(Request $request)
    {
        $notifications = $request->user()->notifications;
        return \Response::json(compact('notifications'));
    }

    //Atualia o status da notificação para 'lida'
    public function destroyNotifications(Request $request)
    {
        $notifications = $request->user()->notifications()->delete();
        return \Response::json(compact('notifications'));
    }

    

}
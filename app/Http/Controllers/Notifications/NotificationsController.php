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
    //Exibe as notificações não lidas para o usuario
    public function notifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications; //recebe dados do usuario logado
        return \Response::json(compact('notifications'));
    }
    //Atualia o status da notificação para 'lida'
    public function updateNotifications(Request $request)
    {
        $notifications = $user->unreadNotifications->update(['read_at' => now()]);
        return \Response::json(compact('notifications'));
    }

}
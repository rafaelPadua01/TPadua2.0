<?php 

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('admin.index');
    }
}

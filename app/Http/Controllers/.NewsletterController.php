<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illumminate\Http\Request;
use App\Newsletter;


class NewsletterController extends Controller
{
    protected $newsletter;

    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function index()
    {
        return view('newsletter.index');
    }
    public function assing(Request $request)
    {
        return view('newsletter.assing');
    }

}

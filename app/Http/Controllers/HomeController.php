<?php

namespace App\Http\Controllers;

use Auth;
use \App\Screenshot;
use \App\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin()){
            return view('nav.admin');
        } else {
            $info["ticket"] = Ticket::info();
            $info["screenshot"] = Screenshot::canupload();

            if(!$info["screenshot"])
                $info["screenshot_time"] = Screenshot::where('account_id', Auth::User()->id)->orderBy('created_at','desc')->first();

            return view('home')->with('info', $info);
        }
    }
}

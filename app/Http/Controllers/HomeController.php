<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Navbar;
use L2\Screenshot;
use L2\Ticket;
use L2\Topic;

class HomeController extends Controller
{
    public $nav = 'home';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin()){
            return view('admin.admin-main')->with(
                [
                    'unread_notifications' => Auth::User()->unreadNotifications,
                    'nav_active' => $this->nav,
                    'a_nav' => Navbar::all(),
                ]);
        } else {
            $info["ticket"] = Ticket::ticket_info();
            $info["screenshot"] = Screenshot::canupload();
            $info["cansubmit"] = Ticket::cansubmit();
            $info["notifications"] = Auth::User()->notifications()->paginate(10);
            $info["ticket_topic"] = Topic::all();


            if(!$info["screenshot"])
                $info["screenshot_time"] = Screenshot::where('account_id', Auth::id())->orderBy('created_at', 'desc')->first();

            return view('home')->with(['info' => $info,'nav_active' => $this->nav]);
        }
    }
}

<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Navbar;
use L2\Screenshot;
use L2\Ticket;
use L2\Topic;

class HomeController extends Controller
{
    private $navigation = 'home';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin()) {

            $adminData = [
                'unreadNotifications' => $this->generateViews(Auth::User()->unreadNotifications),
                'navActive' => $this->navigation,
                'navigation' => Navbar::all(),
            ];

            return view('admin.admin-main')->with($adminData);
        }

        $userData = [
            'tickets' => Ticket::getAllUserTickets(),
            'screenshotCanUpload' => Screenshot::canupload(),
            'lasUpload' => Screenshot::where('account_id', Auth::id())->orderBy('created_at', 'desc')->first(),
            'ticketCanSubmit' => Ticket::cansubmit(),
            'notifications' => $this->generateViews(Auth::User()->notifications()->paginate(10)),
            'ticketTopic' => Topic::all(),
            'navActive' => $this->navigation,
            ];

        return view('home')->with($userData);
    }

    public function generateViews($notifications)
    {
        foreach($notifications as &$notification)
        {
            $notification["view"] = 'notifications.'.last(explode('\\',$notification["type"]));
        }

        return $notifications;
    }
}

<?php

namespace L2\Http\Controllers;

use Auth;
use L2\Repositories\NavbarRepository as Navbar;
use L2\Repositories\ScreenshotRepository as Screenshot;
use L2\Repositories\TicketRepository as Ticket;
use L2\Repositories\TopicRepository as Topic;

class HomeController extends Controller
{
    private $navigation = 'home';
    private $ticket;
    private $screenshot;
    private $topic;
    private $navbar;

    public function __construct(Ticket $ticket, Screenshot $screenshot, Topic $topic, Navbar $navbar)
    {
        $this->middleware('auth');
        $this->ticket = $ticket;
        $this->screenshot = $screenshot;
        $this->topic = $topic;
        $this->navbar = $navbar;
    }

    public function index()
    {
        if(Auth::user()->isAdmin()) {
            return view('nav.admin');
        }

        $userData = [
            'tickets' => $this->ticket->getUserTickets(),
            'screenshotCanUpload' => $this->screenshot->canUpload(),
            'lasUpload' => $this->screenshot->lastUpload(Auth::id()),
            'ticketCanSubmit' => $this->ticket->canSubmit(),
            'notifications' => $this->generateViews(Auth::User()->notifications()->paginate(10)),
            'ticketTopic' => $this->topic->getAll(),
            'navActive' => $this->navigation,
            ];

        return view('user.user-main')->with($userData);
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

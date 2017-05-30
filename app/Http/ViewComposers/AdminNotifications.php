<?php

namespace L2\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use L2\Repositories\ScreenshotRepository as Screenshot;
use L2\Repositories\TicketRepository as Ticket;

class AdminNotifications
{
    private $ticket;
    private $screenshot;

    public function __construct(Ticket $ticket, Screenshot $screenshot)
    {
        $this->ticket = $ticket;
        $this->screenshot = $screenshot;
    }

    public function compose(View $view)
    {
        $data = [
            'unreadNotifications' => $this->generateViews(Auth::User()->unreadNotifications),
            'unansweredTickets' => $this->ticket->doesntHave('replies')->count(),
            'newScreenshots' => $this->screenshot->getAll()->where('approved', 0)->count(),
        ];

        $view->with($data);
    }

    public function generateViews($notifications)
    {
        foreach ($notifications as &$notification) {
            $notification["view"] = 'notifications.' . last(explode('\\', $notification["type"]));
        }

        return $notifications;
    }
}
<?php

namespace L2\Listeners;

use L2\Events\NewTicket;
use L2\Notifications\TicketSubmitted;
use L2\User;

class TicketNotifyAdmin
{
    public function __construct()
    {
        //
    }

    public function handle(NewTicket $event)
    {
        User::where('access_level', '>', 0)->first()->notify(new TicketSubmitted($event->ticket));
    }
}

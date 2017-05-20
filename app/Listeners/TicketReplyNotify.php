<?php

namespace L2\Listeners;

use Auth;
use L2\Events\NewTicketReply;
use L2\Notifications\TicketReply;
use L2\Notifications\UserTicketReply;
use L2\Ticket;
use L2\User;

class TicketReplyNotify
{
    public function __construct()
    {
        //
    }

    public function handle(NewTicketReply $event)
    {
        if(Auth::User()->isAdmin()) {
            $ticket = Ticket::whereId($event->reply->ticket_id)->first();

            User::whereId($ticket->account_id)->first()->notify(new UserTicketReply($event->reply->ticket_id));
        } else {
            User::getAdmin()->notify(new TicketReply($event->reply));
        }
    }
}

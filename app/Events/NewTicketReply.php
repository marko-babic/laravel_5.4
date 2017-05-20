<?php

namespace L2\Events;

use Auth;
use L2\Events\Notifications\AdminNotification;
use L2\Events\Notifications\UserNotification;
use L2\Ticket;
use L2\TicketReply;

class NewTicketReply extends EventBroadcast
{
    public $reply;

    public function __construct(TicketReply $reply)
    {
        $this->reply = $reply;

        if(Auth::User()->isAdmin()) {
            parent::__construct(new UserNotification(Ticket::whereId($reply->ticket_id)->first()->account_id));
        } else {
            parent::__construct(new AdminNotification());
        }
    }
}

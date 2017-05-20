<?php

namespace L2\Events;

use L2\Events\Notifications\AdminNotification;
use L2\Ticket;

class NewTicket extends  EventBroadcast
{
    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;

        parent::__construct(new AdminNotification());
    }
}

<?php

namespace L2\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserTicketReply extends Notification
{
    use Queueable;

    private $ticket_id;

    public function __construct($ticket_id)
    {
        $this->ticket_id = $ticket_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'ticket_id' => $this->ticket_id,
        ];
    }
}

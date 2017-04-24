<?php

namespace L2\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use L2\Ticket;

class TicketSubmitted extends Notification
{
    use Queueable;

    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'login' => \Auth::User()->login,
            'url' => route('ticket.edit',['id' => $this->ticket->id]),
        ];
    }
}

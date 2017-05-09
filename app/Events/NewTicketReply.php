<?php

namespace L2\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use L2\TicketReply;

class NewTicketReply
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;

    public function __construct(TicketReply $reply)
    {
        $this->reply = $reply;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

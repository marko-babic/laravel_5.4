<?php

namespace L2\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use L2\Screenshot;

class NewScreenshot
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $screenshot;

    public function __construct(Screenshot $screenshot)
    {
        $this->screenshot = $screenshot;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

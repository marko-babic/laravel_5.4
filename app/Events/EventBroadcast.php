<?php

namespace L2\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use L2\Events\Notifications\BroadcastInterface;

abstract class EventBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $broadcast;

    public function __construct(BroadcastInterface $broadcast)
    {
        $this->broadcast = $broadcast;
    }

    public function broadcastWith()
    {
        return $this->broadcast->getBroadcastWith();
    }

    public function broadcastOn()
    {
        return $this->broadcast->getBroadcastOn();
    }
}
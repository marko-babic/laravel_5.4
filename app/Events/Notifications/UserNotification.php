<?php

namespace L2\Events\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use L2\User;

class UserNotification implements BroadcastInterface
{
    private $user;

    public function __construct($userId)
    {
        $this->user = User::whereId($userId)->first();
    }

    public function getBroadcastOn()
    {
        return new PrivateChannel('notify-user.'.$this->user->id);
    }

    public function getBroadcastWith()
    {
        return ['number' => count($this->user->unreadNotifications) + 1];
    }
}
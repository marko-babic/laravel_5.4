<?php

namespace L2\Events\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use L2\User;

class AdminNotification implements BroadcastInterface
{
    public function getBroadcastOn()
    {
        return new PrivateChannel('notify-admin');
    }

    public function getBroadcastWith()
    {
        return ['number' => count(User::getAdmin()->unreadNotifications) + 1];
    }
}
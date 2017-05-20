<?php

namespace L2\Events\Notifications;

interface BroadcastInterface
{
    public function getBroadcastOn();
    public function getBroadcastWith();
}
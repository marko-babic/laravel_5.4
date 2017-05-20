<?php

namespace L2\Events;

use L2\Events\Notifications\UserNotification;
use L2\Screenshot;

class CheckedScreenshot extends EventBroadcast
{
    public $screenshot;

    public function __construct(Screenshot $screenshot)
    {
        $this->screenshot = $screenshot;

        parent::__construct(new UserNotification($screenshot->account_id));
    }
}

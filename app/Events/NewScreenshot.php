<?php

namespace L2\Events;

use L2\Events\Notifications\AdminNotification;
use L2\Screenshot;

class NewScreenshot extends EventBroadcast
{
    public $screenshot;

    public function __construct(Screenshot $screenshot)
    {
        $this->screenshot = $screenshot;

        parent::__construct(new AdminNotification());
    }
}

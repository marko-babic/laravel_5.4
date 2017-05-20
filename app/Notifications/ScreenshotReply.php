<?php

namespace L2\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use L2\Screenshot;

class ScreenshotReply extends Notification
{
    use Queueable;

    protected $screenshot;

    public function __construct(Screenshot $screenshot)
    {
        $this->screenshot = $screenshot;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "ss_status" => $this->screenshot->approved,
            "ss_description" => $this->screenshot->description,
        ];
    }
}

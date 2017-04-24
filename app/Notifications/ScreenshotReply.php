<?php

namespace L2\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use L2\Screenshot;

class ScreenshotReply extends Notification
{
    use Queueable;

    protected $status;
    protected $screenshot;

    public function __construct($status, Screenshot $screenshot)
    {
        $this->status = $status;
        $this->screenshot = $screenshot;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "ss_status" => $this->status,
            "ss_description" => $this->screenshot->description,
        ];
    }
}

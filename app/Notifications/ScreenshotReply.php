<?php

namespace App\Notifications;

use App\Screenshot;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

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

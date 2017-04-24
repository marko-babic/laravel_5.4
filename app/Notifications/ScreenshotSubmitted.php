<?php

namespace App\Notifications;

use App\Screenshot;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ScreenshotSubmitted extends Notification
{
    use Queueable;

    protected $screen;

    public function __construct(Screenshot $screen)
    {
        $this->screen = $screen;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'login' => \Auth::User()->login,
            'url' => route('screenshot.index'),
        ];
    }
}

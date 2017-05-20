<?php

namespace L2\Notifications;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use L2\Screenshot;

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
            'login' => Auth::User()->login,
            'url' => route('screenshot.index'),
        ];
    }
}

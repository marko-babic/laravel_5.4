<?php

namespace App\Notifications;

use App\Screenshot;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ScreenshotReply extends Notification
{
    use Queueable;

    protected $status;
    protected $screenshot;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($status, Screenshot $screenshot)
    {
        $this->status = $status;
        $this->screenshot = $screenshot;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "ss_status" => $this->status,
            "ss_description" => $this->screenshot->description,
        ];
    }
}

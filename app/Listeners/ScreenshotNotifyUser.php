<?php

namespace L2\Listeners;

use L2\Events\CheckedScreenshot;
use L2\Notifications\ScreenshotReply;
use L2\User;

class ScreenshotNotifyUser
{
    public function __construct()
    {
        //
    }

    public function handle(CheckedScreenshot $event)
    {
        $user = User::whereId($event->screenshot->account_id)->first();

        $user->notify(new ScreenshotReply($event->screenshot));
    }
}

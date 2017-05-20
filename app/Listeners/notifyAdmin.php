<?php

namespace L2\Listeners;

use L2\Events\NewScreenshot;
use L2\Notifications\ScreenshotSubmitted;
use L2\User;

class notifyAdmin
{
    public function __construct()
    {
        //
    }

    public function handle(NewScreenshot $event)
    {
        User::getAdmin()->notify(new ScreenshotSubmitted($event->screenshot));
    }
}

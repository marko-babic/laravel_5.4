<?php

namespace L2\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'L2\Events\NewScreenshot' => [
            'L2\Listeners\notifyAdmin',
        ],
        'L2\Events\NewTicket' => [
            'L2\Listeners\TicketNotifyAdmin'
        ],
        'L2\Events\NewTicketReply' => [
            'L2\Listeners\TicketReplyNotify'
        ],
        'L2\Events\CheckedScreenshot' => [
            'L2\Listeners\ScreenshotNotifyUser',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

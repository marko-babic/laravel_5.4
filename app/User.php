<?php

namespace L2;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use L2\Notifications\ScreenshotReply;
use L2\Notifications\ScreenshotSubmitted;
use L2\Notifications\TicketReply;
use L2\Notifications\TicketSubmitted;
use L2\Notifications\UserTicketReply;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'login', 'email', 'password', 'displayname', 'lastactive', 'access_level', 'lastServer',
    ];

    protected $table = 'accounts';

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * creates notification, depends on the arg value, for first admin found. One should be set, obviously.
     *
     */

    public function notifyAdmin($notification)
    {
        $admin = $this->where('access_level', '>', 0)->first();

        if (!$admin)
            return false;

        switch ($notification) {
            case 'upload':
                $admin->notify(new ScreenshotSubmitted($this->getLastScreenShot()));
                break;
            case 'ticket';
                $admin->notify(new TicketSubmitted($this->getLastTicket()));
                break;
            case 'ticket_reply':
                $admin->notify(new TicketReply($this->getLastTicketReply()));
        }
    }

    /*
     * creates notification for use who submitted the screenshot.
     */

    public static function notifyUser($notification, $state , Screenshot $screenshot)
    {
        $user = self::whereId($screenshot->account_id)->first();

        switch ($notification) {
            case 'screenshot' :
                $user->notify(new ScreenshotReply($state, $screenshot));
                break;
        }
    }

    /*
     * creates notification for use who submitted the ticket.
     */

    public static function notifyUserTicket($user_id, $ticket_id)
    {
        $user = self::whereId($user_id)->first();

        $user->notify(new UserTicketReply($ticket_id));
    }

    public function isAdmin()
    {
        return $this->access_level;
    }

    public function getLastScreenShot()
    {
        return Screenshot::where('account_id',$this->id)->orderBy('created_at','desc')->first();
    }

    public function getLastTicket()
    {
        return Ticket::where('account_id',$this->id)->orderBy('created_at','desc')->first();
    }

    public function getLastTicketReply()
    {
        return \L2\TicketReply::where('account_id',$this->id)->orderBy('created_at','desc')->first();
    }

    public function tickets()
    {
        return $this->hasMany('\L2\Ticket');
    }

}

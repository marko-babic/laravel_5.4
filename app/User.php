<?php

namespace App;

use App\Notifications\ScreenshotReply;
use App\Notifications\ScreenshotSubmitted;
use App\Notifications\TicketReply;
use App\Notifications\TicketSubmitted;
use App\Notifications\UserTicketReply;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'login', 'email', 'password', 'displayname', 'lastactive', 'access_level', 'lastServer',
    ];

    protected $table = 'accounts';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function notifyAdmin($notification)
    {
        $admin = self::where('access_level', '>', 0)->first();

        if (!$admin)
            return false;

        switch ($notification) {
            case 'upload':
                $admin->notify(new ScreenshotSubmitted());
                break;
            case 'ticket';
                $admin->notify(new TicketSubmitted());
                break;
            case 'ticket_reply':
                $admin->notify(new TicketReply());
        }
    }

    public static function notifyUser($notification, $state , Screenshot $screenshot)
    {
        $user = self::whereId($screenshot->account_id)->first();

        switch ($notification) {
            case 'screenshot' :
                $user->notify(new ScreenshotReply($state, $screenshot));
                break;
        }
    }

    public static function notifyUserTicket($user_id)
    {
        $user = self::whereId($user_id)->first();

        $user->notify(new UserTicketReply());
    }

    public function isAdmin()
    {
        return $this->access_level;
    }

    public function tickets()
    {
        return $this->hasMAny('\App\Ticket');
    }
}

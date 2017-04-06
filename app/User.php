<?php

namespace App;

use App\Screenshot;
use App\Notifications\ScreenshotReply;
use App\Notifications\ScreenshotSubmitted;
use App\Notifications\TicketSubmitted;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'login', 'email', 'password','displayname','lastactive','access_level','lastServer','admin'
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
        $admin = self::where('admin', 1)->first();

        switch ($notification) {
            case 'upload':
                $admin->notify(new ScreenshotSubmitted());
                break;
            case 'ticket';
                $admin->notify(new TicketSubmitted());
                break;
        }
    }

    public static function notifyUser($notification, $state, Screenshot $screenshot)
    {
        $user = self::whereId($screenshot->account_id)->first();

        switch ($notification) {
            case 'screenshot' :
                $user->notify(new ScreenshotReply($state, $screenshot));
                break;
            case 'ticket':
                break;
        }
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function tickets()
    {
        return $this->hasMAny('\App\Ticket');
    }
}

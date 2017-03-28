<?php

namespace App;

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


    public function isAdmin()
    {
        return $this->admin;
    }

    public function tickets()
    {
        return $this->hasMAny('\App\Ticket');
    }
}

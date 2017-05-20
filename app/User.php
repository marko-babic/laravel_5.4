<?php

namespace L2;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'login', 'password','lastServer','lastactive','access_level',
    ];

    protected $table = 'accounts';

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    protected $rememberTokenName = false;


    public function isAdmin()
    {
        return $this->access_level;
    }

    public static function getAdmin()
    {
        return static::where('access_level','>',0)->first();
    }

    public function desc()
    {
        return $this->with('web')->whereId($this->id)->first();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function web()
    {
        return $this->hasOne(UserWeb::class,'account_id');
    }
}

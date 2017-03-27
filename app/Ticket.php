<?php

namespace App;

use \App\TicketReply;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'topic_id','content','account_id','status_id'
    ];

    public static function cansubmit()
    {
        $tickets = self::where(['account_id' => \Auth::User()->id])->get();

        foreach($tickets as $ticket)
        {
            if($ticket->status_id == 2 || $ticket->status_id == 3) {
                return false;
            } elseif($ticket->status_id == 1 && (config('custom.ticket_limit') - ((new \Carbon\Carbon($ticket->created_at, 'UTC'))->diffInHours()) > 0)) {
                return false;
            }
        }

        return true;
    }

    public function replies()
    {
        return $this->hasMany('\App\TicketReply','ticket_id'); //sam za provo
    }

    public static function info()
    {
        $tickets = self::where(['status_id' => 1, 'account_id' => \Auth::user()->id])->with(['user','topic','replies','status'])->first();

        if($tickets)
            TicketReply::cansubmitreply($tickets->id) ? $tickets["cansubmitreply"] = TicketReply::cansubmitreply($tickets->id) : false;

        return $tickets;
    }

    public static function admin_info($id)
    {
        $tickets = self::where(['id' => $id])->with(['user','topic','replies','status'])->first();

        return $tickets;
    }

    public static function alltickets()
    {
        return self::with(['user','topic','replies','status'])->get();
    }

    public function user()
    {
        return $this->belongsTo('\App\User','account_id');
    }

    public function topic()
    {
        return $this->belongsTo('\App\Topic');
    }

    public function status()
    {
        return $this->belongsTo('\App\TicketStatus');
    }
}

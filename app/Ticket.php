<?php

namespace L2;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Misc;

class Ticket extends Model
{
    protected $fillable = [
        'display_id','topic_id','content','account_id','status_id'
    ];

    /*
     * Check whether user can submit support ticket (depends on the custom.conf setup)
     *
     * @return boolean
     */

    public static function cansubmit()
    {
        $tickets = self::where(['account_id' => Auth::id()])->get();

        foreach($tickets as $ticket)
        {
            if($ticket->status_id == 1) {
                return false;
            } elseif ($ticket->status_id == 1 && (!Misc::checkTime($ticket->created_at, config('custom.ticket_limit')))) {
                return false;
            }
        }

        return true;
    }

    /*
     * Gets all user's active tickets
     *
     * @return array $tickets all tickets info
     */

    public static function info()
    {
        $tickets = self::where(['status_id' => 1, 'account_id' => Auth::id()])->with(['user', 'topic', 'replies', 'status'])->first();

        if($tickets)
            TicketReply::cansubmitreply($tickets->id) ? $tickets["cansubmitreply"] = TicketReply::cansubmitreply($tickets->id) : false;

        return $tickets;
    }

    public function isActive($id)
    {
        return $this->whereId($id)->where('status_id',1)->exists();
    }

    /*
     * Gets all user info for admin page
     *
     * @return array $tickets all ticket info
     */


    public static function admin_info($id)
    {
        return self::whereId($id)->with(['user', 'topic', 'replies', 'status'])->first();
    }

    /*
     * return all tickets in the database, for admin only
     *
     * @return array Ticket
     */

    public static function alltickets()
    {
        return self::with(['user','topic','replies','status'])->orderBy('created_at','desc')->get();
    }

    public static function ticket_info()
    {
        return self::where('account_id',Auth::id())->with(['user', 'topic', 'replies', 'status'])->get();
    }

    /*
     * relationships
     */

    public function replies()
    {
        return $this->hasMany('\L2\TicketReply', 'ticket_id')->with('user');
    }

    public function user()
    {
        return $this->belongsTo('\L2\User','account_id');
    }

    public function topic()
    {
        return $this->belongsTo('\L2\Topic');
    }

    public function status()
    {
        return $this->belongsTo('\L2\TicketStatus','status_id');
    }
}

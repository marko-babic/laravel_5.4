<?php

namespace L2;

use Auth;
use Illuminate\Database\Eloquent\Model;
use L2\Events\NewTicket;
use Misc;

class Ticket extends Model
{
    protected $fillable = [
        'display_id','topic_id','content','account_id','status_id'
    ];

    protected $events = [
        'created' =>  NewTicket::class
    ];

    /*
     * Check whether user can submit support ticket (depends on the custom.conf setup)
     *
     * @return boolean
     */

    public static function cansubmit()
    {
        $user_tickets = static::where('account_id',Auth::id())->get();

        foreach($user_tickets as $ticket)
        {
            if($ticket->status_id === 1 || !Misc::checkTime($ticket->created_at, config('custom.ticket_limit')))  {
                return false;
            }
        }

        return true;
    }

    /*
     * Gets user's active ticket - there can only be one active at time.
     *
     * @return array $tickets all tickets info
     */

    public static function info()
    {
        $ticket = self::where(['status_id' => 1, 'account_id' => Auth::id()])->with(['user', 'topic', 'replies', 'status'])->first();

        if(TicketReply::isAllowedToReply($ticket->id) && $ticket) {
            $ticket["cansubmitreply"] = TicketReply::isAllowedToReply($ticket->id);
        }

        return $ticket;
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
        return static::whereId($id)->with(['user', 'topic', 'replies', 'status'])->first();
    }

    /*
     * return all tickets in the database, for admin only
     *
     * @return array Ticket
     */

    public static function getAllTickets()
    {
        return static::with(['user','topic','replies','status'])->orderBy('created_at','desc')->get();
    }

    public static function getAllUserTickets()
    {
        return static::where('account_id',Auth::id())->with(['user', 'topic', 'replies', 'status'])->get();
    }

    /*
     * relationships
     */

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket_id')->with('user');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'account_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class,'status_id');
    }
}

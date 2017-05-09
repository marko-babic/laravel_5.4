<?php

namespace L2;

use Auth;
use Illuminate\Database\Eloquent\Model;
use L2\Events\NewTicketReply;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id','content','account_id'
    ];

    protected $events = [
        'created' => NewTicketReply::class,
    ];


    /*
     * Check whether user can submit reply to the active ticket
     *
     * @param integer $id ticket id
     *
     * @return boolean
     */

    public static function cansubmitreply($id)
    {
        $last = self::where('ticket_id', $id)->orderBy('created_at','desc')->with('ticket')->first();

        if($last) {
            if ($last->account_id == Auth::id() || !$last->ticket->isActive($id)) {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'account_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}

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

    public static function isAllowedToReply($id)
    {
        $last_submit = static::where('ticket_id', $id)->orderBy('created_at','desc')->with('ticket')->first();

        return $last_submit ? $last_submit->account_id != Auth::id() && $last_submit->ticket->isActive($id) : false;
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

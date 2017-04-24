<?php

namespace L2;

use Auth;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id','content','account_id'
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
        return $this->belongsTo('\L2\User','account_id');
    }

    public function ticket()
    {
        return $this->belongsTo('L2\Ticket','ticket_id');
    }
}

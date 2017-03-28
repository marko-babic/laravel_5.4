<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id','content','account_id'
    ];

    public static function cansubmitreply($id)
    {
        $last = self::where('ticket_id', $id)->orderBy('created_at','desc')->first();

        if($last) {
            if ($last->account_id == \Auth::user()->id) {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

    /*
     * Check whether user can submit reply to the active ticket
     *
     * @param integer $id ticket id
     *
     * @return boolean
     */

    public function tickets()
    {
        return $this->belongsTo('\App\Ticket');
    }
}

<?php

namespace L2;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'screenshot_votes';
    protected $fillable = [
        'account_id', 'screenshot_id'
    ];

    /*
     * @return int number of votes left
     */

    public static function votesLeft()
    {
        $votes = Vote::TimeLimit()->get();
        $votes["left"] = config('custom.vote_limit') - count($votes);

        if ($votes["left"] === 0) {
            $votes["next"] = Carbon::now()->diffInMinutes(array_first($votes)->created_at);
        }

        return $votes;
    }

    public function scopeTimeLimit($query)
    {
        return $query->where(
            [
                ['created_at', '>=', Carbon::now()->subHours(config('custom.vote_hour_limit'))],
                ['account_id', '=', Auth::id()],
            ]
        );
    }
}

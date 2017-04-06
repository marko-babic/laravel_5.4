<?php

namespace App;

use Auth;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'screenshot_votes';
    protected $fillable = [
        'account_id', 'screenshot_id'
    ];

    public static function canvote($id)
    {
        if (Screenshot::find($id)->exists()) { // check for approved only
            $vote = Vote::where('screenshot_id', $id)->where('account_id', Auth::id())->exists();
            if (!$vote) {
                $votes = Vote::TimeLimit()->get();

                if (count($votes) < config('custom.vote_limit'))
                    return true;
            }
        }
        return false;
    }

    public static function votesleft()
    {
        $votes = Vote::TimeLimit()->get();
        $votes["left"] = config('custom.vote_limit') - count($votes);

        if ($votes["left"] == 0) {
            $votes["next"] = Carbon::now()->diffInMinutes(array_first($votes)->created_at);
        }

        return $votes;
    }

    public function scopeTimeLimit($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->subHours(config('custom.vote_hour_limit')))->where('account_id', Auth::id());
    }
}

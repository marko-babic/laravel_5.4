<?php

namespace L2;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Misc;

class Screenshot extends Model
{
    protected $fillable = [
        'description', 'path', 'account_id','votes','approved'
    ];

    /*
     * Check whether user can upload screenshot (depends on the custom.conf)
     *
     * @return boolean
     */
    public static function canupload()
    {
        $last_upload = self::where('account_id', Auth::id())->orderBy('created_at', 'desc')->first();

        if($last_upload) {
            if (!Misc::checkTime($last_upload->created_at, config('custom.screenshot_limit')))
                return false;
        }

        return true;
    }

    public static function screens()
    {
        return self::with(['user'])->orderBy('votes', 'desc')->get();
    }

    public function user()
    {
        return $this->belongsTo('\L2\User', 'account_id');
    }
}

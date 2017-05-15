<?php

namespace L2;

use Auth;
use Illuminate\Database\Eloquent\Model;
use L2\Events\CheckedScreenshot;
use L2\Events\NewScreenshot;
use Misc;

class Screenshot extends Model
{
    protected $fillable = [
        'description', 'path', 'account_id','votes','approved'
    ];

    protected $events = [
        'created' => NewScreenshot::class,
        'updated' => CheckedScreenshot::class,
    ];

    /*
     * Check whether user can upload screenshot (depends on the custom.conf)
     *
     * @return boolean
     */
    public static function canupload()
    {
        $last_upload = self::where('account_id', Auth::id())->orderBy('created_at', 'desc')->first();

        return $last_upload ? Misc::checkTime($last_upload->created_at, config('custom.screenshot_limit')) : true;
    }

    public static function screens()
    {
        return self::with(['user'])->orderBy('votes', 'desc')->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'account_id')->with('web');
    }
}

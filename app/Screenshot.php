<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    protected $fillable = [
        'description', 'path', 'account_id','votes','approved'
    ];

    public static function canupload()
    {
        $last_upload = self::where('account_id', \Auth::User()->id)->orderBy('created_at','desc')->first();

        if($last_upload) {
            if(config('custom.screenshot_limit') - ((new \Carbon\Carbon($last_upload->created_at, 'UTC'))->diffInHours()) > 0) {
                return false;
            }
        }

        return true;
    }

    public function user()
    {
        return $this->belongsTo('\App\User','account_id');
    }

    public static function screens()
    {
       return self::with(['user'])->get();
    }
}

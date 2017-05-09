<?php

namespace L2;

use Illuminate\Database\Eloquent\Model;

class UserWeb extends Model
{
    protected $table = 'accounts_web';

    protected $fillable = [
        'account_id', 'email', 'displayname'
    ];
}

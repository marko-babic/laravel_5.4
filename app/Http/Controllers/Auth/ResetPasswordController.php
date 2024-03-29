<?php

namespace L2\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use L2\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = 'home';

    public function __construct()
    {
        $this->middleware('guest');
    }
}

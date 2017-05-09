<?php

namespace L2\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use L2\Http\Controllers\Controller;
use L2\User;
use L2\UserWeb;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:20|unique:accounts',
            'email' => 'required|email|max:255|unique:accounts_web',
            'displayname' => 'required|max:20|unique:accounts_web',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
       $user = \DB::transaction(function ($data) use ($data) {
           $user = User::create([
               'id' => '',
               'login' => $data['login'],
               'lastactive' => 0,
               'access_level' => 0,
               'lastServer' => 1,
               'password' => base64_encode(sha1($data['password'], true)),
           ]);

           UserWeb::create([
               'account_id' => $user->id,
               'displayname' => $data['displayname'],
               'email' => $data['email'],
           ]);

           return $user;
        });

        return $user;
    }
}

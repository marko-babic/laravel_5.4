<?php

namespace L2\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use L2\Http\Controllers\Controller;
use L2\Repositories\UserRepository as User;

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

    protected $redirectTo = 'home';

    private $user;

    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:20|unique:accounts',
            'email' => 'required|email|max:255|unique:accounts_web',
            'displayname' => 'required|max:20|unique:accounts_web',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
       $user = \DB::transaction(function () use ($data) {
           $user = $this->user->create([
               'login' => $data['login'],
               'lastactive' => 0,
               'access_level' => 0,
               'lastServer' => 1,
               'password' => base64_encode(sha1($data['password'], true)),
           ]);

           $user->web()->create([
               'displayname' => $data['displayname'],
               'email' => $data['email'],
           ]);

           return $user;
        });

        return $user;
    }
}

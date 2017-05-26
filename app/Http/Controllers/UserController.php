<?php

namespace L2\Http\Controllers;

use DB;
use Illuminate\Database\QueryException;
use L2\Http\Requests\UserEditRequest;
use L2\Repositories\UserRepository as User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->getAll();

        return view('admin.slugs.users.users')->with('users',$users);
    }

    public function edit($id)
    {
        $user = $this->user->getById($id);

        return view('admin.slugs.users.users-edit')->with('user',$user);
    }

    public function update(UserEditRequest $request, $id)
    {
        $user = $this->user->getById($id);

        try {
            DB::transaction(function () use ($request, $user) {

                $user->update([
                    'login' => $request->input('login'),
                    'access_level' => $request->input('accessLevel'),
                ]);

                $user->web()->update([
                    'displayname' => $request->input('displayName'),
                    'email' => $request->input('email')
                ]);
            });

            session()->flash('userChanged', 'User was successfully updated.');

        } catch (QueryException $e) {
            session()->flash('userChangedError', $e->getMessage());
        }

        return back();
    }
}

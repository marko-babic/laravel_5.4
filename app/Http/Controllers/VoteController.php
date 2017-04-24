<?php

namespace L2\Http\Controllers;


use Auth;
use L2\Http\Requests\VoteVerify;
use L2\Screenshot;
use L2\Vote;

class VoteController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function store(VoteVerify $request)
    {
        \DB::transaction(function () {

            Vote::create([
                'screenshot_id' => request('id'),
                'account_id' => Auth::id()
            ]);

            Screenshot::whereId(request('id'))
                ->increment('votes');
        });
    }
}

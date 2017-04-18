<?php

namespace App\Http\Controllers;


use App\Http\Requests\VoteVerify;
use App\Screenshot;
use App\Vote;
use Auth;

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

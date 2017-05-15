<?php

namespace L2\Http\Controllers;

use Auth;
use DB;
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
        DB::transaction(function ($request) use ($request){

            Vote::create([
                'screenshot_id' => $request->input('id'),
                'account_id' => Auth::id()
            ]);

            Screenshot::whereId($request->input('id'))
                ->increment('votes');
        });
    }
}

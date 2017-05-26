<?php

namespace L2\Http\Controllers;

use Auth;
use DB;
use L2\Http\Requests\VoteVerify;
use L2\Repositories\ScreenshotRepository as Screenshot;
use L2\Repositories\VoteRepository as Vote;

class VoteController extends Controller
{
    private $vote;
    private $screenshot;

    function __construct(Vote $vote, Screenshot $screenshot)
    {
        $this->middleware('auth');
        $this->vote = $vote;
        $this->screenshot = $screenshot;
    }

    /**
     * Creates vote and increments vote count.
     *
     * @param  \L2\Http\Requests\VoteVerify $request
     * @return \Illuminate\Http\Response
     */

    public function store(VoteVerify $request)
    {
        $return = DB::transaction(function () use ($request){

            $new = $this->vote->create([
                'screenshot_id' => $request->input('id'),
                'account_id' => Auth::id()
            ]);

            $new->screen()->increment('votes');
        });

        return is_null($return) ? response('Vote was successful!', 200) : response('Some kind of error', 500);
    }
}

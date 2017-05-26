<?php

namespace L2\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use L2\Repositories\VoteRepository as Vote;

class VoteVerify extends FormRequest
{

    public function authorize(Vote $vote)
    {
        $voted = $vote->voteCheck($this->id, $this->user()->id);

        if ($voted || ($vote->timeLimit() === config('custom.vote_limit'))) {
                return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            'id' =>
                [
                    'required',
                    'integer',
                    'exists:screenshots,id'
                ]
        ];
    }
}

<?php

namespace L2\Repositories;


class VoteRepository extends Repository
{
    public function model()
    {
        return 'L2\Vote';
    }

    public function voteCheck($screenshotId, $userId)
    {
        return $this->model->where(['screenshot_id' => $screenshotId, 'account_id' => $userId])->exists();
    }

    public function timeLimit()
    {
        return $this->model->TimeLimit()->count();
    }
}
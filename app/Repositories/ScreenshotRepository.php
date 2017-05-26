<?php

namespace L2\Repositories;


class ScreenshotRepository extends Repository
{
    public function model()
    {
        return 'L2\Screenshot';
    }

    public function canUpload()
    {
        return $this->model->canupload();
    }

    public function lastUpload($userId)
    {
        return $this->model->where('account_id', $userId)->orderBy('created_at', 'desc')->first();
    }

    public function screens($state)
    {
        return $this->model->screens()->where('approved', $state);
    }
}
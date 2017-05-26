<?php

namespace L2\Repositories;


class PostRepository extends Repository
{
    public function model()
    {
        return 'L2\Post';
    }

    public function getById($id)
    {
        return $this->model->whereId($id)->first();
    }

    public function getIndexPage()
    {
        return $this->model->where('description_id', 1)->orderBy('created_at','desc')->paginate(3);
    }

    public function getSubPage($id)
    {
        return $this->model->where('description_id', $id)->orderBy('created_at','desc')->first();
    }
}
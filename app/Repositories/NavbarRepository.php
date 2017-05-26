<?php

namespace L2\Repositories;


class NavbarRepository extends Repository
{
    public function model()
    {
        return 'L2\Navbar';
    }

    public function getShortcode($shortcode)
    {
        return $this->model->where('shortcode',$shortcode)->first();
    }
}
<?php

namespace L2\Http\ViewComposers;

use Illuminate\View\View;
use L2\Navbar as Links;


class Navbar
{
    protected $navbar = [];


    public function __construct()
    {
        $this->navbar = Links::all();
    }

    public function compose(View $view)
    {
        $view->with(['navbar' => $this->navbar]);
    }
}



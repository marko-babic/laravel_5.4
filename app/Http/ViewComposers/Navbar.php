<?php

namespace L2\Http\ViewComposers;

use Illuminate\View\View;
use L2\Navbar as Links;

class Navbar
{
    private $navigationBar;
    private $unreadNotifications;

    public function __construct()
    {
        $this->navigationBar = Links::all();
    }

    public function compose(View $view)
    {
        $view->with(['navigationBar' => $this->navigationBar]);
    }
}



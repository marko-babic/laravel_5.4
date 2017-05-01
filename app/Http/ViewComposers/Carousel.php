<?php

namespace L2\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use L2\Screenshot;
use L2\Vote;

class Carousel
{
    protected $carouselList = [];
    protected $votes = false;

    public function __construct()
    {
        $this->carouselList = Screenshot::screens()->where('approved', 1);

        if (Auth::check())
            $this->votes = Vote::votesleft();

    }

    public function compose(View $view)
    {
        $view->with(['carousel' => $this->carouselList, 'votes' => $this->votes]);
    }
}



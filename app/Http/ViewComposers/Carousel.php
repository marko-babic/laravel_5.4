<?php

namespace L2\Http\ViewComposers;

use Illuminate\View\View;
use L2\Screenshot;


class Carousel
{
    protected $carouselList = [];

    public function __construct()
    {
        $this->carouselList = Screenshot::screens()->where('approved', 1);
    }

    public function compose(View $view)
    {
        $view->with('carousel', $this->carouselList);
    }
}



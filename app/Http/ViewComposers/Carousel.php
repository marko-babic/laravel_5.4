<?php

namespace App\Http\ViewComposers;

use App\Screenshot;
use Illuminate\View\View;


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



<?php

namespace L2\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CarouselProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.carousel', 'L2\Http\ViewComposers\Carousel');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php


namespace DH\Hero;


use Illuminate\Support\ServiceProvider;

class HeroServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Event::listen('DH.*', 'DH\Hero\EventListener');
    }
}
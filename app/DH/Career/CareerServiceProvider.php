<?php
namespace DH\Career;

use Illuminate\Support\ServiceProvider;

class CareerServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Event::listen('DH.', '\DH\Career\EventListener');
    }
}
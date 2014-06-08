<?php
namespace DH\Import;

use Illuminate\Support\ServiceProvider;

class ImportServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Event::listen('DH.*', 'DH\Import\EventListener');
    }
}
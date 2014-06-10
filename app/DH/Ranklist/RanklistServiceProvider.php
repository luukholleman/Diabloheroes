<?php
namespace DH\Ranklist;

use Illuminate\Support\ServiceProvider;

class RanklistServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
	    \Event::listen('DH.*', 'DH\Ranklist\EventListener');
    }
}
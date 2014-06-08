<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new ImportCareer());
Artisan::add(new ImportHero());
Artisan::add(new ImportItem());
Artisan::add(new ImportTest());
Artisan::add(new RankHero());
Artisan::add(new UpdateRanklists());
Artisan::add(new HeroRanklist());
Artisan::add(new CareerRanklist());
Artisan::add(App::make('SearchIndex'));


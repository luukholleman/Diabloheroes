<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportCareer extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'career:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        DB::connection()->disableQueryLog();

        $regions = array();

        if($this->option('region') != null)
            $regions[] = $this->option('region');
        else
            $regions = [
                \Diabloheroes\D3api\Career::EU,
                \Diabloheroes\D3api\Career::US,
                \Diabloheroes\D3api\Career::KR,
            ];

        foreach($regions as $region)
        {
            $this->importCareer($this->argument('battletag'), $region);
        }
	}

    public function importCareer($battletag, $region)
    {
	    try {
	        $apiCareer = new \Diabloheroes\D3api\Career($battletag, $region);

	        $apiCareer->connector->cache = true;
	        $apiCareer->connector->cachingDir = app_path().'/storage/api/';

	        if($apiCareer->fetch()){
	            $career = Career::firstOrNew(['battletag' => $apiCareer->getBattletag()]);

	            $career->save();

	            $careerRegion = \Career\Region::firstOrNew([
	                'career_id' => $career->id,
	                'region' => $region
	            ]);

	            $careerRegion->fill([
	                'monsters_killed' => $apiCareer->getMonstersKilled(),
	                'hardcore_monsters_killed' => $apiCareer->getHardcoreMonstersKilled(),
	                'elites_killed' => $apiCareer->getElitesKilled(),
	                'time_played' => json_encode($apiCareer->getTimePlayed()),
	                'paragon_level' => $apiCareer->getParagonLevel(),
	                'hardcore_paragon_level' => $apiCareer->getHardcoreParagonLevel(),
	                'last_played_hero' => @$apiCareer->getLastPlayedHero(false)->getId(),
	            ]);

	            $careerRegion->save();

	            echo sprintf("Career %s %s imported\n", $region, $battletag);

		        foreach($apiCareer->getHeroes(false) as $hero)
		        {
			        $existingHero = Hero::whereBlizzardId($hero->getId())->first();

			        if($existingHero == null || $existingHero->eligibleForUpdate($hero->getLastUpdated()))
				        $this->call('hero:import', [
					        'battletag' => $battletag,
					        'hero_id' => $hero->getId(),
					        'region' => $region,
					        '--career' => $career->id,
				        ]);
		        }
	        }
	        else
	        {
	            echo sprintf("Career %s %s NOT imported\n", $region, $battletag);
	        }
	    }
	    catch(Exception $e)
	    {
		    echo $e->getMessage();
	    }
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('battletag', InputArgument::REQUIRED, 'Battletag to import'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
        return [
            array('region', null, InputOption::VALUE_OPTIONAL, 'Region', null),
        ];
//		return array(
//			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
//		);
	}

}

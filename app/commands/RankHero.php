<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RankHero extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hero:rank';

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
		/**
		 * @var Hero $hero
		 */
		$hero = Hero::findOrFail($this->argument('hero'));

//		$base = 1800.00 * 1.4 * 73;
//
//		$total = $base * (1.48 * 3.24);
//
//		echo $total;

		echo $hero->getTotalItemAttributeValue('intelligence')."\n";
		echo $hero->getTotalItemAttributeValue('vitality')."\n";
		echo $hero->getTotalItemAttributeValue('armor')."\n";

		$stats = $hero->heroStats()->with('Stat')->get();


//		dd($stats);
		dd(array_pluck($stats, 'items.0.relations.Stat.attributes.name', 'value'));

		$data = [
			'class' => 'wizard',
			'level' => '70',
			'stats' => [
				'intelligence' => 3100
			]
		];

		$calc = new Diabloheroes\StatCalculator\Calculator($data);

		echo $calc->intelligence;

//		echo $hero->getStatValue('intelligence')."\n";
//		echo $hero->getStatValue('intelligence')."\n";
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('hero', InputArgument::REQUIRED, 'hero id'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
//			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}

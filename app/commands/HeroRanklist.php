<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class HeroRanklist extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ranklist:hero';

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
		DB::disableQueryLog();

		$ranklist = Ranklist::find($this->argument('id'));

		$heroes = Hero::whereLevel(70)->get();

		foreach($heroes as $hero)
		{
			$ranklistRank = Ranklist\Rank::firstOrNew([
				'ranklist_id' => $ranklist->id,
				'rankable_id' => $hero->id,
				'rankable_type' => 'Hero',
				'hardcore' => $hero->hardcore
			]);

			if($hero->updated_at < $ranklistRank->updated_at)
				continue;

			$value = $hero->getRankValue($ranklist);

			if($ranklistRank->value != $value)
				$ranklistRank->value = $value;

			if($ranklistRank->id == null)
				$ranklistRank->rank = 1000001;

			$ranklistRank->save();
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
			array('id', InputArgument::REQUIRED, 'Ranklist id'),
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

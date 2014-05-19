<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CareerRanklist extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ranklist:career';

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

        $careers = Career::all();
//		$heroes = Hero::whereLevel(70)
//			->take(200)
//
//			->get();

        foreach([0, 1] as $hardcore)
        {
            foreach($careers as $career)
            {
                $ranklistRank = Ranklist\Rank::firstOrNew([
                    'ranklist_id' => $ranklist->id,
                    'rankable_id' => $career->id,
                    'rankable_type' => 'Career',
                    'hardcore' => $hardcore
                ]);

                if($career->updated_at < $ranklistRank->updated_at)
                    continue;

                $value = $career->getRankValue($ranklist, $hardcore);

                if($ranklistRank->value != $value)
                    $ranklistRank->value = $value;

                if($ranklistRank->id == null)
                    $ranklistRank->rank = 1000001;

                $ranklistRank->save();
            }
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

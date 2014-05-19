<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateRanklists extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ranklist:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
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
//		DB::disableQueryLog();

		$totalTime = time();

		$ranklists = Ranklist::all();

		foreach($ranklists as $ranklist)
		{
			$time = time();

			DB::transaction(function()use($ranklist){
                if($ranklist->ranklistCategory->type == Ranklist::HERO)
				    $this->call('ranklist:hero', ['id' => $ranklist->id]); // update
                else
                    $this->call('ranklist:career', ['id' => $ranklist->id]);
			});

			echo sprintf("Ranklist %s stats ready in %d seconds\n", $ranklist->name, time() - $time);


			DB::transaction(function()use($ranklist, $time){
				foreach([0, 1] as $hardcore)
				{
					$ranks = $ranklist->ranks()->whereHardcore($hardcore)->orderBy('value', 'desc')->get();

					$i = 1;

					foreach($ranks as $rank)
					{
						$rank->rank = $i++;

						$rank->save();
					}

					echo sprintf("Ranklist %s done in %d seconds\n\n", $ranklist->name, time() - $time);
				}
			});
		}

		echo sprintf("Total time: %d seconds", time() - $totalTime);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
//			array('example', InputArgument::REQUIRED, 'An example argument.'),
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

<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportTest extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'test:import';

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
		$this->call('career:import', ['battletag' => 'aveley#2218']);
		$this->call('career:import', ['battletag' => 'Tigerlady#1595']);
		$this->call('career:import', ['battletag' => 'Toon#1852']);
		$this->call('career:import', ['battletag' => 'Sastron#2126']);
		$this->call('career:import', ['battletag' => 'k1ller#2274']);
		$this->call('career:import', ['battletag' => 'DarkMatter#1238']);
		$this->call('career:import', ['battletag' => 'Desolacer#2339']);
		$this->call('career:import', ['battletag' => 'Torahime#2305']);
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

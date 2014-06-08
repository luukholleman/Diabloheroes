<?php

use DH\Command\CommandBus;
use DH\Import\Command\ImportCareerCommand;
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
//        if($this->option('region') == null)
//            $region = ['eu', 'us', 'kr'];
//        else
//            $region = $this->option('region');
//
//        dd($region);
        CommandBus::execute(new ImportCareerCommand($this->option('region'), $this->argument('battletag')));
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

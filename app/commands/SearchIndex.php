<?php

use DH\Command\CommandBus;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SearchIndex extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'search:index';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Updates the search index';

    /**
     * Create a new command instance.
     *
     * @param DH\Command\CommandBus $commandBus
     * @return \SearchIndex
     */
	public function __construct(CommandBus $commandBus)
	{
        $this->commandBus = $commandBus;

		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        CommandBus::execute(new \DH\Career\Command\QueueCareerForRefreshCommand('Aveley#2218'));

        dd('test');

        $this->commandBus->execute(new \DH\Search\ReindexSearchCommand());
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

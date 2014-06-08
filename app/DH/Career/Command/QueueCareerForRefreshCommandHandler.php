<?php

namespace DH\Career\Command;

use Aveley\Artisanqueue\Queue;
use DH\Command\CommandHandlerInterface;
use DH\Command\CommandInterface;

class QueueCareerForRefreshCommandHandler implements CommandHandlerInterface
{

    /**
     * @param QueueCareerForRefreshCommand $command
     */
    public function handle(CommandInterface $command)
    {
        Queue::artisan('career:import', ['battletag' => $command->battletag]);
    }
}
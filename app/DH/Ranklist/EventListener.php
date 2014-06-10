<?php
namespace DH\Ranklist;

use DH\Command\CommandBus;
use DH\Event\Event;
use DH\Ranklist\Command\UpdateRanksForHeroCommand;

class EventListener
{
    use \DH\Event\EventListener;

    /**
     * @param \DH\Import\Event\HeroWasImported $event
     */
    public function Import_HeroWasImported(Event $event)
    {
        CommandBus::execute(new UpdateRanksForHeroCommand($event->hero));
    }
} 
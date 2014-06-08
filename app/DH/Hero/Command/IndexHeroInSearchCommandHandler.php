<?php

namespace DH\Hero\Command;

use DH\Command\CommandHandlerInterface;
use DH\Command\CommandInterface;
use DH\Event\EventDispatcher;
use DH\Event\EventGenerator;
use DH\Hero\Event\HeroWasIndexedInSearch;

class IndexHeroInSearchCommandHandler implements CommandHandlerInterface
{
    use EventGenerator;

    /**
     * @param IndexHeroInSearchCommand $command
     */
    public function handle(CommandInterface $command)
    {
        \Search::insert('hero-' . $command->hero->id, [
            'title' => $command->hero->name,
            'content' => "{$command->hero->name} Level {$command->hero->level} Hero",
            'status' => 'published'
        ], [
            'link' => route('hero.profile', [$command->hero->id]),
            'name' => $command->hero->name
        ]);

        $this->raise(new HeroWasIndexedInSearch($command->hero));

        EventDispatcher::dispatch($this->queuedEvents);
    }
}
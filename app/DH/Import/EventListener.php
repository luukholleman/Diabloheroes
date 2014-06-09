<?php
namespace DH\Import;

use DH\Event\Event;

class EventListener
{
    use \DH\Event\EventListener;

    public function Import_CareerWasImported(Event $event)
    {
        if (\App::runningInConsole())
            echo sprintf("[Career] %s %s imported\n", $event->region, $event->career->battletag);
    }

    public function Import_CareerWasNotImported(Event $event)
    {
        if (\App::runningInConsole())
            echo sprintf("[Career] %s %s was NOT imported\n", $event->region, $event->battletag);
    }

    public function Import_HeroWasImported(Event $event)
    {
        if (\App::runningInConsole())
            echo sprintf("[Hero] %s was imported\n", $event->hero->name);
    }

    public function Import_HeroWasNotImported(Event $event)
    {
        if (\App::runningInConsole())
            echo sprintf("[Hero] %s was NOT imported\n", $event->hero->name);
    }

    public function Import_ItemWasImported(Event $event)
    {
        if (\App::runningInConsole())
            echo sprintf("[Item] %s was imported\n", $event->item->name);
    }

    public function Import_ItemWasNotImported(Event $event)
    {
        if (\App::runningInConsole())
            echo sprintf("[Item] %s was imported\n", $event->item->name);
    }
}
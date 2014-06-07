<?php


namespace Aveley\CommandBus\Event;


class EventDispatcher {
    public static function dispatch($events)
    {
        foreach($events as $event)
        {
            $eventName = self::resolveEventName($event);

            \Event::fire($eventName, $event);

            \Log::info("Event [$eventName] was fired");
        }
    }

    private static function resolveEventName($event)
    {
        return str_replace('\\', '.', get_class($event));
    }
} 
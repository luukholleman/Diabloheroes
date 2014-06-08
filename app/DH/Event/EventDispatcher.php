<?php


namespace DH\Event;


class EventDispatcher
{
    public static function dispatch($events)
    {
        if(is_array($events))
        {
            foreach ($events as $event)
                self::throwEvent($event);

            return;
        }

        self::throwEvent($events);
    }

    private static function throwEvent($event)
    {
        $eventName = self::resolveEventName($event);

        \Event::fire($eventName, $event);

        \Log::info("Event [$eventName] was fired");
    }

    private static function resolveEventName($event)
    {
        return str_replace('\\', '.', get_class($event));
    }
} 
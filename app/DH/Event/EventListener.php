<?php


namespace Aveley\CommandBus\Event;


trait EventListener {
    public function handle($event)
    {
        $eventName = get_class($event);

        $parts = explode('\\', $eventName);

        $method = $parts[1].'_'.array_pop($parts);

        $this->$method();
    }
} 
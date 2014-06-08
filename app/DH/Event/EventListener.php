<?php


namespace DH\Event;


trait EventListener
{
    public function handle($event)
    {
        $eventName = get_class($event);

        $parts = explode('\\', $eventName);

        $method = $parts[1] . '_' . array_pop($parts);

        \Log::info("Looking for method [$method] in ".get_class($this));

        if (method_exists($this, $method))
            $this->$method($event);
    }
} 
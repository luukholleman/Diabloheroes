<?php

namespace Aveley\CommandBus\Event;

trait EventGenerator {

    protected $queuedEvents = [];

    public function raise($event)
    {
        $this->queuedEvents[] = $event;
    }

    public function releaseEvents()
    {
        $events = $this->queuedEvents;

        $this->queuedEvents = [];

        return $events;
    }
} 
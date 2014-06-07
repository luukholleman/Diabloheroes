<?php


namespace DH\Hero\Event;


class HeroWasIndexedInSearch {
    public $hero;

    function __construct($hero)
    {
        $this->hero = $hero;
    }
} 
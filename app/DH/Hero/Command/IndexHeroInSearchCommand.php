<?php

namespace DH\Hero\Command;

use DH\Command\CommandInterface;

class IndexHeroInSearchCommand implements CommandInterface
{
    /**
     * @var \Hero
     */
    public $hero;

    function __construct(\Hero $hero)
    {
        $this->hero = $hero;
    }
} 
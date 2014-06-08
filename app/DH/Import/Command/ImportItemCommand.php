<?php
namespace DH\Import\Command;

use DH\Command\CommandInterface;

class ImportItemCommand implements CommandInterface
{
    public $region;

    public $hero;

    public $slot;

    public $tooltipParams;

    function __construct($region, \Hero $hero, $slot, $tooltipParams)
    {
        $this->hero = $hero;
        $this->tooltipParams = $tooltipParams;
        $this->region = $region;
        $this->slot = $slot;
    }
} 
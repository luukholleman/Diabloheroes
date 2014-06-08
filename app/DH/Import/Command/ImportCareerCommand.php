<?php


namespace DH\Import\Command;


use DH\Command\CommandInterface;

class ImportCareerCommand implements CommandInterface
{
    public $battletag;

    public $region;

    function __construct($region, $battletag)
    {
        $this->region = $region;
        $this->battletag = $battletag;
    }
} 
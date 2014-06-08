<?php
namespace DH\Import\Command;

use DH\Command\CommandInterface;

class ImportHeroCommand implements CommandInterface
{
    public $region;

    public $careerId;

    public $battletag;

    public $heroId;

    function __construct($region, $battletag, \Career\Region $careerRegion, $heroId)
    {
        $this->battletag = $battletag;
        $this->careerRegion = $careerRegion;
        $this->heroId = $heroId;
        $this->region = $region;
    }
} 
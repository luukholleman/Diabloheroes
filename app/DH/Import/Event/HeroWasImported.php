<?php
namespace DH\Import\Event;

use DH\Event\Event;

/**
 * Class HeroWasImported
 * @package DH\Import\Event
 */
class HeroWasImported implements Event
{
    /**
     * @var
     */
    public $region;

    /**
     * @var
     */
    public $battletag;

    /**
     * @var \Career\Region
     */
    public $career;

    /**
     * @var
     */
    public $hero;

    /**
     * @param $region
     * @param $battletag
     * @param \Career\Region $careerRegion
     * @param $hero
     */
    public function __construct($region, $battletag, \Career\Region $careerRegion, $hero)
    {
        $this->region = $region;
        $this->battletag = $battletag;
        $this->career = $careerRegion;
        $this->hero = $hero;
    }
} 
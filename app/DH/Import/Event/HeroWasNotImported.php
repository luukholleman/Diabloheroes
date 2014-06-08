<?php
namespace DH\Import\Event;

/**
 * Class HeroWasNotImported
 * @package DH\Import\Event
 */
class HeroWasNotImported
{
    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $battletag;

    /**
     * @var \Career\Region
     */
    public $careerRegion;

    /**
     * @var int
     */
    public $heroId;

    /**
     * @param $region
     * @param \Career\Region $careerRegion
     * @param $heroId
     */
    public function __construct($region, $battletag, \Career\Region $careerRegion, $heroId)
    {
        $this->region = $region;
        $this->battletag = $battletag;
        $this->careerRegion = $careerRegion;
        $this->heroId = $heroId;
    }
} 
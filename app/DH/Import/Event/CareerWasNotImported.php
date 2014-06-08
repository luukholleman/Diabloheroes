<?php
namespace DH\Import\Event;

use DH\Event\Event;

/**
 * Class CareerWasNotImported
 * @package DH\Import\Event
 */
class CareerWasNotImported implements Event
{
    /**
     * @var
     */
    public $region;

    /**
     * @var \Career
     */
    public $battletag;

    /**
     * @param $region
     * @param \Career $battletag
     */
    function __construct($region, $battletag)
    {
        $this->battletag = $battletag;
        $this->region = $region;
    }
} 
<?php
namespace DH\Import\Event;

use DH\Event\Event;

/**
 * Class CareerWasImported
 * @package DH\Import\Event
 */
class CareerWasImported implements Event
{
    /**
     * @var string
     */
    public $region;
    /**
     * @var \Career
     */
    public $career;

    /**
     * @param \Career $career
     */
    function __construct($region, \Career $career)
    {
        $this->region = $region;
        $this->career = $career;
    }
} 
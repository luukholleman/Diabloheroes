<?php
namespace DH\Import\Event;

use DH\Event\Event;

/**
 * Class ItemWasNotImported
 * @package DH\Import\Event
 */
class ItemWasNotImported implements Event
{
    /**
     * @var
     */
    public $region;

    /**
     * @var
     */
    public $tooltipParams;

    /**
     * @param $region
     * @param $tooltipParams
     */
    public function __construct($region, $tooltipParams)
    {
        $this->region = $region;
        $this->tooltipParams = $tooltipParams;
    }
} 
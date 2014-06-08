<?php
namespace DH\Import\Event;

use DH\Event\Event;

/**
 * Class ItemWasImported
 * @package DH\Import\Event
 */
class ItemWasImported implements Event
{
    /**
     * @var
     */
    public $region;

    /**
     * @var \Item
     */
    public $item;

    /**
     * @param $region
     * @param \Item $item
     */
    public function __construct($region, \Item $item)
    {
        $this->region = $region;
        $this->item = $item;
    }
} 
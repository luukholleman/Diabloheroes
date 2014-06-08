<?php


namespace DH\Career\Command;

use DH\Command\CommandInterface;

class QueueCareerForRefreshCommand implements CommandInterface
{
    public $battletag;

    function __construct($battletag)
    {
        $this->battletag = $battletag;
    }
} 
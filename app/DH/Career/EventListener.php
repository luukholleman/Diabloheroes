<?php
namespace DH\Career;

class EventListener
{
    use \DH\Event\EventListener;

    public function Import_CareerWasImported($region, \Career $career){
        echo sprintf("Career %s %s imported\n", $region, $career->battletag);
        
    }
} 
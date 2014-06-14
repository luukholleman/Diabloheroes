<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/26/14
 * Time: 11:26 AM
 */

namespace Diabloheroes\D3api;

class Gem {
    public $data;
    public $slot;

    public function __construct($data, $slot)
    {
        $this->data = $data;
        $this->slot = $slot;
    }

    public function getSlot()
    {
        return $this->slot;
    }

    public function getId()
    {
        return $this->data['item']['id'];
    }

    public function getName()
    {
        return $this->data['item']['name'];
    }

    public function getIcon()
    {
        return $this->data['item']['icon'];
    }

    public function getDisplayColor()
    {
        return $this->data['item']['displayColor'];
    }

    public function getTooltipParams()
    {
        return $this->data['item']['tooltipParams'];
    }

    public function getAttributes()
    {
        return $this->data['attributes']['primary'];
    }

    public function getAttributesRaw()
    {
        return $this->data['attributes']['attributesRaw'];
    }
} 
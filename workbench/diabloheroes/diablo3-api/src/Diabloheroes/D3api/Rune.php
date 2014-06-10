<?php

namespace Diabloheroes\D3api;

class Rune {
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getSlug()
    {
        return $this->data['slug'];
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function getType()
    {
        return $this->data['type'];
    }

    public function getLevel()
    {
        return $this->data['level'];
    }

    public function getCategorySlug()
    {
        return $this->data['categorySlug'];
    }

    public function getTooltipUrl()
    {
        return $this->data['tooltipParams'];
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getSimpleDescription()
    {
        return $this->data['simpleDescription'];
    }

    public function getSkillCalcId()
    {
        return $this->data['skillCalcId'];
    }

    public function getOrder()
    {
        return $this->data['order'];
    }
} 
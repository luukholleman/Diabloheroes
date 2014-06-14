<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/26/14
 * Time: 12:24 PM
 */

namespace Diabloheroes\D3api;


class PassiveSkill {
    public $data;

    public function __construct($data)
    {
        $this->data = $data['skill'];
    }

    public function getSlug()
    {
        return $this->data['slug'];
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function getIcon()
    {
        return $this->data['icon'];
    }

    public function getLevel()
    {
        return $this->data['level'];
    }

    public function getTooltipUrl()
    {
        return $this->data['tooltipUrl'];
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getFlavor()
    {
        return $this->data['flavor'];
    }

    public function getSkillCalcId()
    {
        return $this->data['skillCalcId'];
    }
} 
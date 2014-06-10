<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/26/14
 * Time: 12:21 PM
 */

namespace Diabloheroes\D3api;


class ActiveSkill {
    public $data;
    public $rune;

    public function __construct($data)
    {
        $this->data = $data['skill'];

        if(!empty($data['rune']))
            $this->rune = new Rune($data['rune']);
    }

    public function hasRune()
    {
        return $this->rune != null;
    }

    public function getRune()
    {
        return $this->rune;
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

    public function getCategorySlug()
    {
        return $this->data['categorySlug'];
    }

    public function getTooltipUrl()
    {
        return $this->data['tooltipUrl'];
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
} 
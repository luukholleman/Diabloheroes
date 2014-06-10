<?php
/**
 * Created by PhpStorm.
 * User: luuk
 * Date: 4/9/14
 * Time: 5:53 PM
 */

namespace Diabloheroes\D3api\Connector;

class Hero extends Connector implements IHero
{
    protected $urlPattern = 'http://%s.battle.net/api/d3/profile/%s/hero/%d';

    public function get($region, $battletag, $id)
    {
        return parent::request(sprintf($this->urlPattern, $region, $battletag, $id));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/12/14
 * Time: 2:49 AM
 */

namespace Diabloheroes\D3api\Connector;

class Item extends Connector implements IItem
{
    protected $urlPattern = 'http://%s.battle.net/api/d3/data/%s';

    public function get($region, $params)
    {
        return parent::request(sprintf($this->urlPattern, $region, $params));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: luuk
 * Date: 4/9/14
 * Time: 5:53 PM
 */

namespace Diabloheroes\D3api\Connector;

class Career extends Connector
{
    protected $urlPattern = 'http://%s.battle.net/api/d3/profile/%s/';

    public function get($region, $battletag)
    {
        return parent::request(sprintf($this->urlPattern, $region, $battletag));
    }
}
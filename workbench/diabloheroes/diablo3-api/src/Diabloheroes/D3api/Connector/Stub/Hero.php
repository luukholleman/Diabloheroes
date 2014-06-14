<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/12/14
 * Time: 2:24 AM
 */

namespace Diabloheroes\D3api\Connector\Stub;

use Diabloheroes\D3api\Connector\IHero;

class Hero implements IHero{

    function request($url)
    {
        // TODO: Implement request() method.
    }

    function get($region, $battletag, $id)
    {
        return file_get_contents(__DIR__.'/Examples/hero.json');
    }
}
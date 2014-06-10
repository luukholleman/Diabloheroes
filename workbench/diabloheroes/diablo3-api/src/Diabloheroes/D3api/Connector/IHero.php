<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/12/14
 * Time: 1:40 AM
 */

namespace Diabloheroes\D3api\Connector;


interface IHero {
    function request($url);
    function get($region, $battletag, $id);
} 
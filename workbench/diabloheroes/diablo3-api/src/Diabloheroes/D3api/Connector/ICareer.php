<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/12/14
 * Time: 1:36 AM
 */

namespace Diabloheroes\D3api\Connector;

interface ICareer {
    function request($url);
    function get($region, $battletag);
} 
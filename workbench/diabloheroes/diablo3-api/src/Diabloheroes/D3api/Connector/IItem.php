<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/12/14
 * Time: 2:50 AM
 */

namespace Diabloheroes\D3api\Connector;

interface IItem {
    function request($url);
    function get($region, $params);
} 
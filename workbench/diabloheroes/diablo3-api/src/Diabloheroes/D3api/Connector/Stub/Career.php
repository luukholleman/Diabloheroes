<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/12/14
 * Time: 1:36 AM
 */

namespace Diabloheroes\D3api\Connector\Stub;

use Diabloheroes\D3api\Connector\ICareer;

class Career implements ICareer{
    public function request($url)
    {

    }

    public function get($region, $battletag)
    {
        return file_get_contents(__DIR__.'/Examples/career.json');
    }
}
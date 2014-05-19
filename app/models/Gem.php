<?php
/**
 * Created by PhpStorm.
 * 
 * User: Luuk
 * Date: 4/26/14
 * Time: 11:35 AM
 *
 * @property integer $id
 * @property string $blizzard_id
 * @property string $name
 * @property string $icon
 * @property string $display_color
 * @property string $tooltip_params
 */

class Gem extends Eloquent{
    public $guarded = ['id'];

    public $timestamps = false;
} 
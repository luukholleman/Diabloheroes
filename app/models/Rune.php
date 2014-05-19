<?php
/**
 * Created by PhpStorm.
 * 
 * User: Luuk
 * Date: 4/26/14
 * Time: 1:02 PM
 *
 * @property integer $id
 * @property string $type
 * @property string $slug
 * @property string $name
 * @property integer $level
 * @property string $tooltip_url
 * @property string $description
 * @property string $simple_description
 * @property string $skill_calc_id
 * @property integer $order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */

class Rune extends Eloquent{
    public $guarded = ['id'];
} 
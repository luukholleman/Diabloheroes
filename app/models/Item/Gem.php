<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/26/14
 * Time: 11:36 AM
 */

namespace Item;


class Gem extends \Eloquent {
    public $guarded = ['id'];

    public $table = 'item_gems';
} 
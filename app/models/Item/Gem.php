<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/26/14
 * Time: 11:36 AM
 */

namespace Item;


/**
 * Item\Gem
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $gem_id
 * @property integer $slot
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Gem extends \Eloquent {
    public $guarded = ['id'];

    public $table = 'item_gems';
} 
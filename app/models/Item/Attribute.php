<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/26/14
 * Time: 10:42 AM
 */

namespace Item;


/**
 * Item\Attribute
 *
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\Item\Attribute whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item\Attribute whereName($value) 
 */
class Attribute extends \Eloquent {
    public $guarded = ['id'];

    public $table = 'item_attributes';

    public $timestamps = false;
} 
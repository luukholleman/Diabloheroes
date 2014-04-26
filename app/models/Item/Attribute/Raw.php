<?php

namespace Item\Attribute;

/**
 * Item\Attribute\Raw
 *
 * @package Item\Attribute
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $item_attribute_id
 * @property float $min
 * @property float $max
 * @method static \Illuminate\Database\Query\Builder|\Item\Attribute\Raw whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item\Attribute\Raw whereItemId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item\Attribute\Raw whereItemAttributeId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item\Attribute\Raw whereMin($value) 
 * @method static \Illuminate\Database\Query\Builder|\Item\Attribute\Raw whereMax($value) 
 */
class Raw extends \Eloquent {
    /**
     * @var array
     */
    public $guarded = ['id'];

    /**
     * @var string
     */
    public $table = 'item_attribute_raw';

    /**
     * @var bool
     */
    public $timestamps = false;
} 
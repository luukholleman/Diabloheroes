<?php

/**
 * Stat
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stat whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stat whereUpdatedAt($value)
 */
class Stat extends Eloquent{
    public $guarded = ['id'];
} 
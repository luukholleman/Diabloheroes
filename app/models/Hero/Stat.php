<?php
namespace Hero;


/**
 * Hero\Stat
 *
 * @property integer $id
 * @property integer $stat_id
 * @property integer $hero_id
 * @property float $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Hero\Stat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero\Stat whereStatId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero\Stat whereHeroId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero\Stat whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero\Stat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero\Stat whereUpdatedAt($value)
 */
class Stat extends \Eloquent {
    public $guarded = ['id'];

    public $table = 'hero_stats';
} 
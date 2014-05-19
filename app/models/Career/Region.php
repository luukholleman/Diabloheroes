<?php
namespace Career;


/**
 * Career\Region
 *
 * @property integer $id
 * @property integer $career_id
 * @property string $region
 * @property integer $monsters_killed
 * @property integer $hardcore_monsters_killed
 * @property integer $elites_killed
 * @property string $time_played
 * @property integer $paragon_level
 * @property integer $hardcore_paragon_level
 * @property integer $last_played_hero
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Career $career
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hero[] $heroes
 */
class Region extends \Eloquent{
    public $guarded = ['id'];

    public $table = 'career_regions';

	public static $regions = [
		'us' => 'Americas',
		'kr' => 'Asia',
		'eu' => 'Europe',
	];

    const SOFTCORE = 0;
    const HARDCORE = 1;

    public function career()
    {
        return $this->belongsTo('Career');
    }

	public function heroes()
	{
		return $this->hasMany('Hero', 'career_region_id');
	}

    public function getTimePlayedAttribute($value)
    {
        return json_decode($value);
    }

	public function getFullRegionAttribute()
	{
		return self::$regions[$this->region];
	}
} 
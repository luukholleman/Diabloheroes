<?php

/**
 * Hero
 *
 * @property integer $id
 * @property integer $career_id
 * @property integer $blizzard_id
 * @property string $name
 * @property boolean $gender
 * @property integer $level
 * @property boolean $hardcore
 * @property boolean $dead
 * @property string $last_played
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Hero whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereCareerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereBlizzardId($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereHardcore($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereDead($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereLastPlayed($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Hero whereUpdatedAt($value)
 * @property integer $career_region_id
 * @property string $region
 * @property string $klass
 * @property-read \Career\Region $careerRegion
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hero\Skill\Active[] $skillActives
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hero\Skill\Passive[] $skillPassives
 * @property-read \Illuminate\Database\Eloquent\Collection|\Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hero\Stat[] $heroStats
 * @property-read mixed $resource_uri
 * @property-read mixed $battletag_slug
 * @property-read mixed $detail_uri
 */
class Hero extends Eloquent{
    public $guarded = ['id'];

    protected $appends = [
//        'resource_uri',
//        'detail_uri',
//        'career_region'
    ];

	public static $modes = [
		'0' => 'Softcore',
		'1' => 'Hardcore'
	];

	public static $stats = [
		'strength' => 'Strength_Item',
		'intelligence' => 'Intelligence_Item',
		'vitality' => 'Vitality_Item',
		'armor' => 'Armor_Item',
	];

    public function careerRegion()
    {
        return $this->belongsTo('Career\Region');
    }

	public function skillActives()
	{
		return $this->hasMany('\Hero\Skill\Active');
	}

	public function skillPassives()
	{
		return $this->hasMany('\Hero\Skill\Passive');
	}

	public function ranks()
	{
		return $this->morphMany('\Ranklist\Rank', 'rankable');
	}

	/**
	 * @return \Item[]
	 */
	public function items()
	{
		return $this->hasMany('Item');
	}

	public function heroStats()
	{
		return $this->hasMany('Hero\Stat');
	}

    public function destroySkillActives()
    {
        foreach($this->skillActives as $skillActive)
        {
            $skillActive->delete();
        }
    }

	public function getResourceUriAttribute()
	{
		return URL::action('Api\V1\HeroController@getDetail', ['id' => $this->id]);
	}

	public function getBattletagSlugAttribute()
	{
		return Str::slug($this->careerRegion->career->battletag);
	}

	public function getDetailUriAttribute()
	{
		return URL::to(sprintf('profile/%s/hero/%d', $this->battletag_slug, $this->blizzard_id));
	}

	public function eligibleForUpdate($timestamp){
		$new = new DateTime(date('c', $timestamp));
		$exist = new DateTime($this->last_played);

		return $new > $exist;
	}

	public function getTotalItemAttributeValue($stat)
	{
		$itemAttribute = \Item\Attribute::whereName(self::$stats[$stat])->firstOrFail();

		$value = 0;

		foreach($this->items as $item)
		{
			$value += $item->getStatValue($itemAttribute);
		}

		return $value;
	}

	public function getRankValue(Ranklist $ranklist)
	{
		$stat = Stat::whereName($ranklist->stat)->first();

		if($stat == null)
			return 0;

		return $this->heroStats()->whereStatId($stat->id)->first()->value;
	}

	public function getParagonLevelAttribute()
	{
		if(!$this->hardcore)
			return $this->careerRegion->paragon_level;
		else
			return $this->careerRegion->hardcore_paragon_level;
	}

	public function getRank(Ranklist $ranklist)
	{
        $ranks = $this->ranks()->whereRanklistId($ranklist->id)->first();

//        var_dump(DB::getQueryLog());
//        var_dump($ranklist->id);
//        var_dump($ranks);

        return $ranks;
//		return Cache::remember(sprintf('hero.rank.%d.%d', $this->id, $ranklist->id), 5, function() use ($ranklist){
//			return
//		});

	}

	public function getModeAttribute()
	{
		return self::$modes[$this->hardcore];
	}
} 
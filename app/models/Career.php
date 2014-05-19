<?php

/**
 * Career
 *
 * @property integer $id
 * @property string $battletag
 * @property integer $monsters_killed
 * @property integer $hardcore_monsters_killed
 * @property integer $elites_killed
 * @property integer $time_played
 * @property integer $paragon_level
 * @property integer $hardcore_paragon_level
 * @property integer $last_played_hero
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Career whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereBattletag($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereMonstersKilled($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereHardcoreMonstersKilled($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereElitesKilled($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereTimePlayed($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereParagonLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereHardcoreParagonLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereLastPlayedHero($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Career whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Career\Region[] $careerRegion
 */
class Career extends \Eloquent {
    public $guarded = ['id'];

	public function careerRegions()
	{
		return $this->hasMany('Career\Region');
	}

	public function ranks()
	{
		return $this->morphMany('\Ranklist\Rank', 'rankable');
	}

    public function getRankValue($ranklist, $hardcore)
    {
        switch($ranklist->stat)
        {
            case "paragon":
                return $this->getMaxParagonLevel($hardcore);

        }
    }

    public function getMaxParagonLevel($hardcore)
    {
        $max = 0;

        foreach($this->careerRegions as $careerRegion)
            if($hardcore == \Career\Region::SOFTCORE)
            {
                if($careerRegion->paragon_level > $max) $max = $careerRegion->paragon_level;
            }
            else
            {
                if($careerRegion->hardcore_paragon_level > $max) $max = $careerRegion->hardcore_paragon_level;
            }

        return $max;
    }

}
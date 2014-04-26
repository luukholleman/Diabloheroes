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
 */
class Career extends \Eloquent {
    public $guarded = ['id'];
}
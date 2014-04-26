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
 */
class Hero extends Eloquent{
    public $guarded = ['id'];

    public function skillActives()
    {
        return $this->hasMany('\Hero\Skill\Active');
    }

    public function destroySkillActives()
    {
        foreach($this->skillActives as $skillActive)
        {
            $skillActive->delete();
        }
    }
} 
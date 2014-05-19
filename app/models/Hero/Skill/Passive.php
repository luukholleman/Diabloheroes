<?php

namespace Hero\Skill;


/**
 * Hero\Skill\Passive
 *
 * @property integer $id
 * @property integer $skill_passive_id
 * @property integer $hero_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Skill\Passive $skillPassive
 */
class Passive extends \Eloquent{
    public $guarded = ['id'];

    public $table = 'hero_skill_passives';

	public function skillPassive()
	{
		return $this->belongsTo('Skill\Passive');
	}
} 
<?php

namespace Hero\Skill;


/**
 * Hero\Skill\Active
 *
 * @property integer $id
 * @property integer $skill_active_id
 * @property integer $hero_id
 * @property integer $rune_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Skill\Active $skillActive
 * @property-read \Rune $rune
 */
class Active extends \Eloquent {
    public $guarded = ['id'];

    public $table = 'hero_skill_actives';

	public function skillActive()
	{
		return $this->belongsTo('Skill\Active');
	}

	public function rune()
	{
		return $this->belongsTo('Rune');
	}

	public function hasRune()
	{
		return $this->rune_id != null;
	}
} 
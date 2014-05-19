<?php

namespace Skill;


/**
 * Skill\Passive
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $icon
 * @property integer $level
 * @property string $tooltip_url
 * @property string $description
 * @property string $flavor
 * @property string $skill_calc_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Passive extends \Eloquent{
    public $guarded = ['id'];

    public $table = 'skill_passives';
} 
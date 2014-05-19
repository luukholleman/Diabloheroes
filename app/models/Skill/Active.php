<?php

namespace Skill;


/**
 * Skill\Active
 *
 * @property integer $id
 * @property integer $skill_active_category_id
 * @property string $slug
 * @property string $name
 * @property string $icon
 * @property integer $level
 * @property string $tooltip_url
 * @property string $description
 * @property string $simple_description
 * @property string $skill_calc_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Active extends \Eloquent{
    public $guarded = ['id'];

    public $table = 'skill_actives';
} 
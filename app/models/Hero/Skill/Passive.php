<?php

namespace Hero\Skill;


class Passive extends \Eloquent{
    public $guarded = ['id'];

    public $table = 'hero_skill_passives';
} 
<?php

/**
 * Ranklist
 *
 * @property integer $id
 * @property integer $ranklist_category_id
 * @property string $name
 * @property string $stat
 * @property-read \Ranklist\Category $ranklistCategory
 */
class Ranklist extends Eloquent{
	public $guarded = ['id'];

	public $timestamps = false;

	const CAREER = 'career';
	const HERO = 'hero';

	public function ranklistCategory()
	{
		return $this->belongsTo('Ranklist\Category');
	}

	public function ranks()
	{
		return $this->hasMany('\Ranklist\Rank');
	}
} 
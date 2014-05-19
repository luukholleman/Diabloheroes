<?php
namespace Ranklist;


class Rank extends \Eloquent{
	public $guarded = [];

	public $table = 'ranklist_ranks';

	public function rankable()
	{
		return $this->morphTo();
	}
} 
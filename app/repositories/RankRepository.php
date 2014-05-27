<?php

class RankRepository implements RepositoryInterface {

	const SOFTCORE = true;
	const HARDCORE = false;
	const BOTH = null;

	static $MODES = [
		'softcore' => self::SOFTCORE,
		'hardcore' => self::HARDCORE,
		'both' => self::BOTH,
	];

	public function getTop($mode, Ranklist $ranklist)
	{
		$ranks = \Ranklist\Rank::whereRanklistId($ranklist->id);

		if($mode !== self::BOTH)
			$ranks = $ranks->whereHardcore($mode);

		return $ranks->orderBy('value', 'desc');
	}

} 
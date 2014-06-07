<?php

class RankRepository implements RepositoryInterface {

	public function getTop($mode, Ranklist $ranklist)
	{
		$ranks = \Ranklist\Rank::whereRanklistId($ranklist->id);

		if($mode !== null)
			$ranks = $ranks->whereHardcore($mode);

		return $ranks->orderBy('value', 'desc');
	}

} 
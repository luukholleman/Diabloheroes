<?php

namespace Api\V1;

class RanklistController extends BaseApiController{
	public function getIndex()
	{
		$ranklists = \Ranklist::with('RanklistCategory')
						->get();

		return \Response::json($ranklists);
	}

//	public function getTop($ranklist, $hardcore){
//		if()
//
//	}
} 
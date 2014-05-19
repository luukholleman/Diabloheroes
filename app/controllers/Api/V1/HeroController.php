<?php
namespace Api\V1;

class HeroController extends BaseApiController {
	public function getIndex()
	{
		$heroes = \Hero::whereHardcore(\Input::get('hardcore'))
			->with('CareerRegion.Career')
			->paginate(20);

		return \Response::json($heroes);
	}

    public function getDetail($id)
    {
	    $hero = \Hero::with('CareerRegion')
	        ->with('CareerRegion.Career')
	        ->with('CareerRegion.Career.CareerRegion')
	        ->with('CareerRegion.Career.CareerRegion.Heroes')
		    ->with('SkillActives')
		    ->with('SkillActives.Rune')
		    ->with('SkillActives.SkillActive')
		    ->with('SkillPassives')
		    ->with('SkillPassives.SkillPassive')
		    ->with('Items')
	        ->whereBlizzardId($id)
	        ->first();

	    if($hero == null)
		    throw new HeroNotFoundException(sprintf("Hero with id %d was not found", $id));

        return \Response::json($hero);
    }
} 
<?php

class HeroRepository {

	public $hero;

	public function __construct(Hero $hero)
	{
		$this->hero = $hero;
	}

	public function getSoftcoreHeroesTop(Ranklist $ranklist)
	{
		return $this->getHeroesTop($ranklist, false);
	}

	public function getHardcoreHeroesTop(Ranklist $ranklist)
	{
		return $this->getHeroesTop($ranklist, true);
	}

	public function getHeroesTop(Ranklist $ranklist, $hardcore)
	{
		$ranks = \Ranklist\Rank::whereRanklistId($ranklist->id);

        if($hardcore !== null)
			$ranks = $ranks->whereHardcore($hardcore);

        return $ranks->orderBy('value', 'desc');
	}

	public function findOrFail($id)
	{
		return $this->hero->findOrFail($id);
	}

	public function findOrFailBlizzardId($blizzardId)
	{
		return $this->hero->whereBlizzardId($blizzardId)->firstOrFail();
	}

	public function getSiblings($id)
	{
		$hero = $this->findOrFail($id);

		$siblings = new \Illuminate\Support\Collection();

		foreach($hero->careerRegion->career->careerRegions as $careerRegion)
			foreach($careerRegion->heroes as $sibling)
				$siblings->push($sibling);

		$siblings->sortByDesc(function($sibling){
			return $sibling->level;
		});

		return $siblings;
	}

	public function getMaxLevelCount($hardcore)
	{
		return $this->hero->whereHardcore($hardcore)->count();
//		return $this->hero->whereLevel(70)->whereHardcore($hardcore)->count();
	}
} 
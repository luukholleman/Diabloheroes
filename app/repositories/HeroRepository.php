<?php

class HeroRepository implements RepositoryInterface  {

	public $hero;

	public function __construct(Hero $hero)
	{
		$this->hero = $hero;
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
		return $this->hero->whereLevel(70)->whereHardcore($hardcore)->count();
	}

	public function getSkillActives(Hero $hero)
	{
		return $hero->skillActives;
	}

	public function getSkillPassives(Hero $hero)
	{
		return $hero->skillPassives;
	}
} 
<?php

class HeroController extends BaseController{

	public $heroRepository;

	public $ranklistRepository;

	public function __construct(HeroRepository $heroRepository, RanklistRepository $ranklistRepository)
	{
		$this->heroRepository = $heroRepository;
		$this->ranklistRepository = $ranklistRepository;
	}

	public function getProfile($blizzardId)
	{
		$hero = $this->heroRepository->findOrFailBlizzardId($blizzardId);

		$siblings = $this->heroRepository->getSiblings($hero->id);

		$ranklistCategories = $this->ranklistRepository->getHeroCategories();

		$total = $this->heroRepository->getMaxLevelCount($hero->hardcore);

		return View::make('hero.profile')
			->with('hero', $hero)
			->with('siblings', $siblings)
			->with('ranklistCategories', $ranklistCategories)
			->with('total', $total);
	}

	public function getStats($blizzardId)
	{
		$hero = $this->heroRepository->findOrFailBlizzardId($blizzardId);

//		$stats = $this->

	}
} 
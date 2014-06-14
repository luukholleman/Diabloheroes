<?php

namespace DH\Ranklist\Controller;

class RanklistController extends \DH\Base\Controller\BaseController {

    public $ranklistRepository;

    public function __construct(\RanklistRepository $ranklistRepository, \HeroRepository $heroRepository)
    {
        $this->ranklistRepository = $ranklistRepository;
        $this->heroRepository = $heroRepository;
    }

	public function index()
	{
		return $this->ranklist($this->ranklistRepository->getMainRanklist()->stat);
	}

	public function ranklist($ranklistStat = null)
	{
		if(is_null($ranklistStat))
			$ranklistStat = $this->ranklistRepository->getMainRanklist()->stat;

		$ranklist = $this->ranklistRepository->getRanklistByStat($ranklistStat);

        if($ranklist->ranklistCategory->type == \Ranklist::HERO)
            return $this->showHeroRanklist($ranklist);
        else
            return $this->showCareerRanklist($ranklist);
    }

    public function showHeroRanklist(\Ranklist $ranklist)
    {
        $ranklistCategories = $this->ranklistRepository->getAllCategories();

        if(\Input::get('hardcore', true))
            $ranks = $this->heroRepository->getSoftcoreHeroesTop($ranklist)->paginate(20);
        else
            $ranks = $this->heroRepository->getHardcoreHeroesTop($ranklist)->paginate(20);

        return View::make('ranklist.hero')
            ->with('ranklist', $ranklist)
            ->with('ranklistCategories', $ranklistCategories)
            ->with('ranks', $ranks);
    }

    public function showCareerRanklist(\Ranklist $ranklist)
    {
        $ranklistCategories = $this->ranklistRepository->getAllCategories();
        $softcoreCareers = $this->careerRepository->getSoftcoreCareersTop($ranklist)->take(20)->get();
        $hardcoreCareers = $this->careerRepository->getHardcoreCareersTop($ranklist)->take(20)->get();

        return \View::make('home.career')
            ->with('ranklist', $ranklist)
            ->with('ranklistCategories', $ranklistCategories)
            ->with('softcoreCareers', $softcoreCareers)
            ->with('hardcoreCareers', $hardcoreCareers);
    }
} 
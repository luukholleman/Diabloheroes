<?php

/**
 * Class HomeController
 */
class HomeController extends BaseController {

	/**
	 * @var RanklistRepository
	 */
	public $ranklistRepository;
    /**
     * @var HeroRepository
     */
    public $heroRepository;
    /**
     * @var CareerRepository
     */
    public $careerRepository;

	/**
	 * @param RanklistRepository $ranklistRepository
	 * @param HeroRepository $heroRepository
	 */
	public function __construct(RanklistRepository $ranklistRepository, HeroRepository $heroRepository, CareerRepository $careerRepository)
	{
		$this->ranklistRepository = $ranklistRepository;
		$this->heroRepository = $heroRepository;
		$this->careerRepository = $careerRepository;
	}

	public function showIndex()
	{
		return $this->showRanklist($this->ranklistRepository->getMainRanklist()->stat);
	}

	/**
	 * @param null $ranklistStat
	 * @return \Illuminate\View\View
	 */
	public function showRanklist($ranklistStat = null, $mode = 'softcore', $region = 'us')
	{
		$ranklist = $this->ranklistRepository->getRanklistByStat($ranklistStat);

//		throw new Exception();

		if($ranklist->ranklistCategory->type == Ranklist::HERO)
			return $this->showHeroRanklist($ranklist, $mode, $region);
		else
			return $this->showCareerRanklist($ranklist);
	}

	private function showHeroRanklist(Ranklist $ranklist, $mode, $region)
	{
		$ranklistCategories = $this->ranklistRepository->getAllCategories();

        if($mode == 'softcore')
		    $ranks = $this->heroRepository->getSoftcoreHeroesTop($ranklist)->paginate(value(Config::get('ua.pagination')));
        else if($mode == 'hardcore')
		    $ranks = $this->heroRepository->getHardcoreHeroesTop($ranklist)->paginate(value(Config::get('ua.pagination')));
        else
            $ranks = $this->heroRepository->getHeroesTop($ranklist, null)->paginate(value(Config::get('ua.pagination')));

		return View::make('home.hero')
			->with('currentRanklist', $ranklist)
			->with('ranklistCategories', $ranklistCategories)
			->with('ranks', $ranks)
            ->with('mode', $mode)
			->with('rankMultiplier', 1 + 20 * ($ranks->getCurrentPage() - 1));
	}

	private function showCareerRanklist(Ranklist $ranklist)
	{
		$ranklistCategories = $this->ranklistRepository->getAllCategories();
		$softcoreCareers = $this->careerRepository->getSoftcoreCareersTop($ranklist)->take(20)->get();
		$hardcoreCareers = $this->careerRepository->getHardcoreCareersTop($ranklist)->take(20)->get();

		return View::make('home.career')
			->with('ranklist', $ranklist)
			->with('ranklistCategories', $ranklistCategories)
			->with('softcoreCareers', $softcoreCareers)
			->with('hardcoreCareers', $hardcoreCareers);
	}

}
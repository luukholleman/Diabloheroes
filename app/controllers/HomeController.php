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
	 * @var RankRepository
	 */
	public $rankRepository;

	/**
	 * @param RanklistRepository $ranklistRepository
	 * @param RankRepository $rankRepository
	 * @param HeroRepository $heroRepository
	 * @param CareerRepository $careerRepository
	 */
	public function __construct(RanklistRepository $ranklistRepository, RankRepository $rankRepository, HeroRepository $heroRepository, CareerRepository $careerRepository)
	{
		$this->ranklistRepository = $ranklistRepository;
		$this->heroRepository = $heroRepository;
		$this->careerRepository = $careerRepository;
		$this->rankRepository = $rankRepository;
	}

	public function showIndex()
	{
		return $this->showRanklist($this->ranklistRepository->getMainRanklist()->stat);
	}

	/**
	 * @param null $ranklistStat
	 * @param string $mode
	 * @param string $region
	 * @return \Illuminate\View\View
	 */
	public function showRanklist($ranklistStat = null, $mode = 'softcore', $region = 'us')
	{
		$ranklist = $this->ranklistRepository->getRanklistByStat($ranklistStat);

		if($ranklist->ranklistCategory->type == Ranklist::HERO)
			return $this->showHeroRanklist($ranklist, new Mode($mode), $region);
		else
			return $this->showCareerRanklist($ranklist, $mode, $region);
	}

	private function showHeroRanklist(Ranklist $ranklist, Mode $mode, $region)
	{
		$ranklistCategories = $this->ranklistRepository->getAllCategories();

		$ranks = $this->rankRepository->getTop($mode->bool(), $ranklist)->paginate(value(Config::get('ua.pagination')));

		return View::make('home.hero')
			->with('currentRanklist', $ranklist)
			->with('ranklistCategories', $ranklistCategories)
			->with('ranks', $ranks)
            ->with('mode', $mode)
			->with('rankMultiplier', 1 + 20 * ($ranks->getCurrentPage() - 1));
	}

	private function showCareerRanklist(Ranklist $ranklist, $mode, $region)
	{
		$ranklistCategories = $this->ranklistRepository->getAllCategories();

		$ranks = $this->rankRepository->getTop(RankRepository::$MODES[$mode], $ranklist)->paginate(value(Config::get('ua.pagination')));

		return View::make('home.career')
			->with('currentRanklist', $ranklist)
			->with('ranklistCategories', $ranklistCategories)
			->with('ranks', $ranks)
			->with('mode', $mode)
			->with('rankMultiplier', 1 + 20 * ($ranks->getCurrentPage() - 1));
	}

}
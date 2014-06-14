<?php

/**
 * Class RanklistRepository
 */
class RanklistRepository implements RepositoryInterface
{
	/**
	 * @var Ranklist\Category
	 */
	public $ranklistCategory;
	/**
	 * @var Ranklist
	 */
	public $ranklist;

	/**
	 * @param \Ranklist\Category $ranklistCategory
	 * @param Ranklist $ranklist
	 */
	public function __construct(Ranklist\Category $ranklistCategory, Ranklist $ranklist)
	{
		$this->ranklistCategory = $ranklistCategory;
		$this->ranklist = $ranklist;
	}

	public function getMainRanklist()
	{
		return Ranklist::whereStat('heroscore')->firstOrFail();
	}

    /**
     * @return Ranklist\Category[]
     */
    public function getHeroCategories()
    {
        return $this->getCategories(Ranklist::HERO);
    }

    /**
     * @return Ranklist\Category[]
     */
    public function getCareerCategories()
    {
        return $this->getCategories(Ranklist::CAREER);
    }

	public function getHeroRanklists()
	{
		$ranklists = new \Illuminate\Support\Collection;

		foreach($this->getHeroCategories() as $heroCategory)
			foreach($heroCategory->ranklists as $ranklist)
				$ranklists->push($ranklist);

		return $ranklists;
	}

	/**
	 * @param $type
	 *
	 * @return Ranklist\Category[]
	 */
    private function getCategories($type)
    {
        return $this->ranklistCategory
            ->with('ranklists')
            ->whereType($type)
            ->orderBy('order')
            ->get();
    }

    /**
     * @return Ranklist\Category[]
     */
    public function getAllCategories()
    {
        return $this->ranklistCategory
            ->with('ranklists')
            ->orderBy('order')
            ->get();
    }

	/**
	 * @return Ranklist\Category[]
	 */
	public function all()
	{
		return $this->ranklist->all();
	}

	/**
	 * @param $stat
	 * @return Ranklist
	 *
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function getRanklistByStat($stat)
	{
		return $this->ranklist->whereStat($stat)->firstOrFail();
	}
} 
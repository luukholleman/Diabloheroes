<?php

class CareerRepository implements RepositoryInterface  {

    public function getSoftcoreCareersTop(Ranklist $ranklist)
    {
        return $this->getCareersTop($ranklist, false);
    }

    public function getHardcoreCareersTop(Ranklist $ranklist)
    {
        return $this->getCareersTop($ranklist, true);
    }

    public function getCareersTop(Ranklist $ranklist, $hardcore)
    {
        return \Ranklist\Rank::whereRanklistId($ranklist->id)
            ->whereHardcore($hardcore)
            ->orderBy('rank');
    }
} 
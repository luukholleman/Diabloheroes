<?php
namespace DH\Ranklist\Command;

use DH\Command\CommandHandlerInterface;
use DH\Command\CommandInterface;

/**
 * Class UpdateRanksForHeroCommandHandler
 * @package DH\Ranklist\Command
 */
class UpdateRanksForHeroCommandHandler implements CommandHandlerInterface
{
	/**
	 * @var \Ranklist
	 */
	public $ranklistRepository;

	/**
	 * @var \Ranklist\Rank
	 */
	public $ranklistRank;

	/**
	 * @param \RanklistRepository $ranklistRepository
	 * @param \Ranklist\Rank $ranklistRank
	 */
	function __construct(\RanklistRepository $ranklistRepository, \Ranklist\Rank $ranklistRank)
	{
		$this->ranklistRepository = $ranklistRepository;
		$this->ranklistRank = $ranklistRank;
	}

	/**
	 * @param \DH\Ranklist\Command\UpdateRanksForHeroCommand $command
	 */
	public function handle(CommandInterface $command)
	{
		if($command->hero->level < \Config::get('dh.min_ranking_level'))
			return; // hero does not meet the level requirement

		foreach($this->ranklistRepository->getHeroRanklists() as $ranklist)
		{
			$value = $command->hero->getRankValue($ranklist);

			$nextRank = $this->ranklistRank
				->where('ranklist_id', '=', $ranklist->id)
				->where('value', '>=', $value)
				->where('hardcore', '=', (int)$command->hero->hardcore)
				->orderBy('value')
				->first();

			if($nextRank == false)
				$rank = 1;
			else
				$rank = $nextRank->rank + 1;

			$this->ranklistRank->create([
				'ranklist_id' => $ranklist->id,
				'rankable_id' => $command->hero->id,
				'rankable_type' => 'Hero',
				'hardcore' => (int)$command->hero->hardcore,
				'rank' => $rank,
				'value' => $value
			]);
		}
	}
}
<?php
namespace DH\Ranklist\Command;

use DH\Command\CommandInterface;

/**
 * Class UpdateRanksForHeroCommand
 * @package DH\Ranklist\Command
 */
class UpdateRanksForHeroCommand implements CommandInterface
{
	/**
	 * @var \Hero
	 */
	public $hero;

	/**
	 * @param \Hero $hero
	 */
	function __construct(\Hero $hero)
	{
		$this->hero = $hero;
	}
} 
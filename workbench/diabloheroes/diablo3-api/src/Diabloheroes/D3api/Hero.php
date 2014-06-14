<?php
/**
 * Created by PhpStorm.
 * User: luuk
 * Date: 4/9/14
 * Time: 6:22 PM
 */

namespace Diabloheroes\D3api;

use Diabloheroes\D3api\Connector\Hero as Connector;

/**
 * Class Hero
 * @package Diabloheroes\D3api
 */
class Hero
{
	private $url = 'http://%s.battle.net/api/d3/profile/%s/hero/%s';

	const LIFE = "life";
	const DAMAGE = "damage";
	const ATTACKSPEED = "attackSpeed";
	const ARMOR = "armor";
	const STRENGTH = "strength";
	const DEXTERITY = "dexterity";
	const VITALITY = "vitality";
	const INTELLIGENCE = "intelligence";
	const PHYSICALRESIST = "physicalResist";
	const FIRERESIST = "fireResist";
	const COLDRESIST = "coldResist";
	const LIGHTNINGRESIST = "lightningResist";
	const POISONRESIST = "poisonResist";
	const ARCANERESIST = "arcaneResist";
	const CRITDAMAGE = "critDamage";
	const BLOCKCHANCE = "blockChance";
	const BLOCKAMOUNTMIN = "blockAmountMin";
	const BLOCKAMOUNTMAX = "blockAmountMax";
	const DAMAGEINCREASE = "damageIncrease";
	const CRITCHANCE = "critChance";
	const DAMAGEREDUCTION = "damageReduction";
	const THORNS = "thorns";
	const LIFESTEAL = "lifeSteal";
	const LIFEPERKILL = "lifePerKill";
	const GOLDFIND = "goldFind";
	const MAGICFIND = "magicFind";
	const LIFEONHIT = "lifeOnHit";
	const PRIMARYRESOURCE = "primaryResource";
	const SECONDARYRESOURCE = "secondaryResource";

	const EU = 'eu';
	const US = 'us';
	const KR = 'kr';

	public function __construct($battletag, $id, $region, $initialData = null)
	{
		$this->battletag = str_replace('#', '-', $battletag);
		$this->id = $id;
		$this->region = $region;

		if (isset($initialData))
			$this->data = $initialData;

		$this->connector = new Connector();
	}

	public function fetch()
	{
		$this->data = $this->connector->get($this->region, $this->battletag, $this->id);

		if ($this->data == false)
			return false;

		$this->data = json_decode($this->data, true);

		if(isset($this->data['code']))
			return false;

		return true;
	}

	public function getId()
	{
		return $this->data['id'];
	}

	public function getName()
	{
		return $this->data['name'];
	}

	public function getClass()
	{
		return $this->data['class'];
	}

	public function getGender()
	{
		return $this->data['gender'];
	}

	public function isMale()
	{
		return $this->data['gender'] == 0;
	}

	public function isFemale()
	{
		return $this->data['gender'] == 1;
	}

	public function getLevel()
	{
		return $this->data['level'];
	}

	public function getParagonLevel()
	{
		return $this->data['paragonLevel'];
	}

	public function isHardcore()
	{
		return $this->getHardcore();
	}

	public function getHardcore()
	{
		return $this->data['hardcore'];
	}

	public function getDead()
	{
		return $this->data['dead'];
	}

	public function isDead()
	{
		return $this->getDead();
	}

	public function getLastUpdated()
	{
		return $this->data['last-updated'];
	}

	public function getEliteKills()
	{
		return $this->data['kills']['elites'];
	}

	public function getStats()
	{
		return $this->data['stats'];
	}

	public function getStat($stat)
	{
		return $this->data['stats'][$stat];
	}

	public function getItems()
	{
		$items = array();

		foreach($this->data['items'] as $slot => $item)
		{
			$newItem = new Item($item['tooltipParams'], $this->region, $item, $slot);

            $newItem->connector->cache = $this->connector->cache;
            $newItem->connector->cachingDir = $this->connector->cachingDir;

			$newItem->fetch();

			$items[] = $newItem;
		}

		return $items;
	}

	public function getActiveSkills(){
		$skills = array();

		foreach($this->data['skills']['active'] as $skill)
		{
			if(!empty($skill))
				$skills[] = new ActiveSkill($skill);
		}

		return $skills;
	}

	public function getPassiveSkills(){
		$skills = array();

		foreach($this->data['skills']['passive'] as $skill)
		{
			if(!empty($skill))
				$skills[] = new PassiveSkill($skill);
		}

		return $skills;
	}
}
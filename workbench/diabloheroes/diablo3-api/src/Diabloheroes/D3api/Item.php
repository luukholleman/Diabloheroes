<?php
/**
 * @author Luuk Holleman
 * @email luukholleman@gmail.com
 */

namespace Diabloheroes\D3api;

use Diabloheroes\D3api\Connector\Item as Connector;

class Item
{
	public $connector;

	private $params;

	private $region;

	public $data;

	private $slot;

	const EU = 'eu';
	const US = 'us';
	const KR = 'kr';

	public function __construct($params, $region, $initialData = null, $slot = null)
	{
		$this->params = $params;
		$this->region = $region;
		$this->slot = $slot;

		if (isset($initialData))
			$this->data = $initialData;

		$this->connector = new Connector();
	}

	public function fetch()
	{
		$this->data = $this->connector->get($this->region, $this->params);

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

	public function getIcon()
	{
		return $this->data['icon'];
	}

	public function getDisplayColor()
	{
		return $this->data['displayColor'];
	}

	public function getTooltipParams()
	{
		return $this->data['tooltipParams'];
	}

	public function getRequiredLevel()
	{
		return $this->data['requiredLevel'];
	}

	public function getItemLevel()
	{
		return $this->data['itemLevel'];
	}

	public function getBonusAffixes()
	{
		return $this->data['bonusAffixes'];
	}

	public function getBonusAffixesMax()
	{
		return $this->data['bonusAffixesMax'];
	}

	public function getAccountBound()
	{
		return $this->data['accountBound'];
	}

	public function getTypeName()
	{
		return $this->data['typeName'];
	}

	public function getTwoHanded()
	{
		return $this->data['type']['twoHanded'];
	}

	public function getTypeId()
	{
		return $this->data['type']['id'];
	}

	public function getArmor()
	{
		if(isset($this->data['armor']))
			return $this->data['armor'];

		return array();
	}

	public function getArmorMin()
	{
		if(isset($this->data['armor']))
			return $this->data['armor']['min'];

		return 0;
	}

	public function getArmorMax()
	{
		if(isset($this->data['armor']))
			return $this->data['armor']['max'];

		return 0;
	}

	public function getAttributes(){
		return $this->data['attributes'];
	}

	public function getPrimaryAttributes(){
		return $this->data['attributes']['primary'];
	}

	public function getSecondaryAttributes(){
		return $this->data['attributes']['secondary'];
	}

	public function getPassiveAttributes(){
		return $this->data['attributes']['passive'];
	}

	public function getRawAttributes(){
		return $this->data['attributesRaw'];
	}

	public function getRandomAffixes(){
		return $this->data['attributesRaw'];
	}

	public function getGems(){
		$gems = array();

		foreach($this->data['gems'] as $key => $gem)
		{
			$gems[] = new Gem($gem, $key + 1);
		}

		return $gems;
	}

	public function getGemCount()
	{
		return count($this->data['gems']);
	}

	public function getSocketEffects(){
		return $this->data['socketEffects'];
	}

	public function getCraftedBy(){
		return $this->data['socketEffects'];
	}

	public function getSlot()
	{
		return $this->slot;
	}
}
<?php

class Klass {
	const WIZARD = 0;
	const DEMON_HUNTER = 1;
	const CRUSADER = 2;
	const BARBARIAN = 3;
	const WICTH_DOCTOR = 4;
	const MONK = 5;

	private $klasses = [
		'wizard' => self::WIZARD,
		'demon-hunter' => self::DEMON_HUNTER,
		'crusader' => self::CRUSADER,
		'barbarian' => self::BARBARIAN,
		'witch-doctor' => self::WICTH_DOCTOR,
		'monk' => self::MONK
	];

	private $klass;

	private $short;

	public function __construct($klass)
	{
		if(!isset($this->klasses[$klass]))
			throw new InvalidArgumentException(sprintf('Class %s does not exists', $klass));

		$this->klass = $this->klasses[$klass];

		$this->short = $klass;
	}

	public function short()
	{
		return $this->short;
	}

	public function __toString()
	{
		switch ($this->klass){
			case self::WIZARD:
				return 'Wizard';
			case self::DEMON_HUNTER:
				return 'Demon Hunter';
			case self::CRUSADER:
				return 'Crusader';
			case self::BARBARIAN:
				return 'Barbarian';
			case self::WICTH_DOCTOR:
				return 'Witch Doctor';
			case self::MONK:
				return 'Monk';
		}
	}
} 
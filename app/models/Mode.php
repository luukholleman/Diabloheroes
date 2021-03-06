<?php

class Mode {

	const SOFTCORE = false;
	const HARDCORE = true;
	const BOTH = null;

	private $validSoftcore = [
		'softcore',
		0,
        '0',
		false
	];

	private $validHardcore = [
		'hardcore',
		1,
        '1',
		true
	];

	private $validBoth = [
		'both',
		2,
        '2',
		null
	];

	private $mode;

	public function __construct($mode)
	{
		if(is_string($mode))
			$mode = strtolower($mode);

		if(in_array($mode, $this->validSoftcore, true)){
			$this->mode = self::SOFTCORE;
		}

		else if(in_array($mode, $this->validHardcore, true))
			$this->mode = self::HARDCORE;

		else if(in_array($mode, $this->validBoth, true))
			$this->mode = self::BOTH;

		else
			throw new InvalidArgumentException(sprintf("Mode %s is not supported", $mode));
	}

	public function bool()
	{
		return $this->mode;
	}

	public function __toString()
	{
		if($this->mode == self::SOFTCORE)
			return 'Softcore';

		if($this->mode == self::HARDCORE)
			return 'Hardcore';

		if($this->mode == self::BOTH)
			return 'Both';
	}

	public function isSoftcore()
	{
		return $this->bool() === false;
	}

	public function isHardcore()
	{
		return $this->bool() === true;
	}

	public function isBoth()
	{
		return $this->bool() === null;
	}
} 
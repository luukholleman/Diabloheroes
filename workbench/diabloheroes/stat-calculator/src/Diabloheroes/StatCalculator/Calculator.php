<?php

namespace Diabloheroes\StatCalculator;

class Calculator {
	public $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function __get($key)
	{
		if($key == 'intelligence')
			return $this->data['stats'][$key];
	}
} 
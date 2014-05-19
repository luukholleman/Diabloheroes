<?php

use Laracasts\TestDummy\DbTestCase;
use Laracasts\TestDummy\Factory;

class HeroModelTest extends DbTestCase {
	/**
	 * @test
	 */
	public function getDetailUriAttribute()
	{
		$hero = Factory::create('Hero');

		$this->assertSame(URL::to('profile/aveley2218/hero/1'), $hero->getDetailUriAttribute());


	}
} 
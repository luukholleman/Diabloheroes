<?php

use Diabloheroes\D3api\Career;
use Diabloheroes\D3api\Connector\Stub\Career as StubCareer;

class CareerTest extends \PHPUnit_Framework_TestCase
{
    private $career;

    /**
     * Load the career with a stub connection
     * Stub json is located in Connector/Stub/Examples
     */
    public function setUp()
    {
        $this->career = new Career('Aveley#2218', Career::EU);

        $this->career->connector = new StubCareer();

        $this->career->fetch();
    }

    public function test_getHeroes()
    {
        $heroes = $this->career->getHeroes();

        $this->assertNotEmpty($heroes);

        foreach ($heroes as $hero) {
            $this->assertInstanceOf('\Diabloheroes\D3api\Hero', $hero);
        }
    }

//    public function test_getFallenHeroes()
//    {
//        $this->assert($this->career->getFallenHeroes());
//    }

    public function test_getLastPlayedHero()
    {
        $this->assertInstanceOf('\Diabloheroes\D3api\Hero', $this->career->getLastPlayedHero());
    }

    public function test_getMonstersKilled()
    {
        $this->assertSame(80798, $this->career->getMonstersKilled());
    }

    public function test_getElitesKilled()
    {
        $this->assertSame(6036, $this->career->getElitesKilled());
    }

    public function test_getHardcoreMonstersKilled()
    {
        $this->assertSame(1573, $this->career->getHardcoreMonstersKilled());
    }

    public function test_getTimePlayed()
    {
        $this->assertSame(0.378, $this->career->getTimePlayed(Career::BARBARIAN));
        $this->assertSame(0.0, $this->career->getTimePlayed(Career::CRUSADER));
        $this->assertSame(0.613, $this->career->getTimePlayed(Career::DEMON_HUNTER));
        $this->assertSame(0.055, $this->career->getTimePlayed(Career::MONK));
        $this->assertSame(0.15, $this->career->getTimePlayed(Career::WITCH_DOCTOR));
        $this->assertSame(1.0, $this->career->getTimePlayed(Career::WIZARD));
    }

    public function test_getParagonLevel()
    {
        $this->assertSame(73, $this->career->getParagonLevel());
    }

    public function get_getHardcoreParagonLevel()
    {
        $this->assertSame(2, $this->career->getHardcoreParagonLevel());
    }

    public function test_battletag()
    {
        $this->assertSame('Aveley#2218', $this->career->getBattletag());
    }

    public function test_getProgression()
    {
        $this->assertSame(array(
            'act1' => true,
            'act2' => true,
            'act3' => true,
            'act4' => true,
            'act5' => true,
        ), $this->career->getProgression());

        $this->assertSame(true, $this->career->getProgression(Career::ACT1));
        $this->assertSame(true, $this->career->getProgression(Career::ACT2));
        $this->assertSame(true, $this->career->getProgression(Career::ACT3));
        $this->assertSame(true, $this->career->getProgression(Career::ACT4));
        $this->assertSame(true, $this->career->getProgression(Career::ACT5));
    }
}
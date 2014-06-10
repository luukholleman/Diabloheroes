<?php
/**
 * Created by PhpStorm.
 * User: Luuk
 * Date: 4/12/14
 * Time: 2:20 AM
 */

use Diabloheroes\D3api\Connector\Stub\Hero as StubHero;
use Diabloheroes\D3api\Hero;

class HeroTestCase extends \PHPUnit_Framework_TestCase
{
    private $hero;

    private $stats = array(
        "life" => 375316,
        "damage" => 451689.0,
        "attackSpeed" => 1.4699999749660493,
        "armor" => 5141,
        "strength" => 77,
        "dexterity" => 77,
        "vitality" => 3324,
        "intelligence" => 7055,
        "physicalResist" => 1098,
        "fireResist" => 1093,
        "coldResist" => 969,
        "lightningResist" => 969,
        "poisonResist" => 969,
        "arcaneResist" => 1092,
        "critDamage" => 3.84,
        "blockChance" => 0.0,
        "blockAmountMin" => 0,
        "blockAmountMax" => 0,
        "damageIncrease" => 0.0,
        "critChance" => 0.0,
        "damageReduction" => 0.0,
        "thorns" => 2724.0,
        "lifeSteal" => 0.0,
        "lifePerKill" => 3483.0,
        "goldFind" => 0.65,
        "magicFind" => 0.0,
        "lifeOnHit" => 5056.0,
        "primaryResource" => 147,
        "secondaryResource" => 0
    );

    public function setUp()
    {
        $this->hero = new Hero('Aveley#2218', 123456, Hero::EU);

        $this->hero->connector = new StubHero();

        $this->hero->fetch();
    }

    public function test_getId()
    {
        $this->assertSame(23407878, $this->hero->getId());
    }

    public function test_getName()
    {
        $this->assertSame('Aveley', $this->hero->getName());
    }

    public function test_getClass()
    {
        $this->assertSame('wizard', $this->hero->getClass());
    }

    public function test_getGender()
    {
        $this->assertSame(1, $this->hero->getGender());
    }

    public function test_isMale()
    {
        $this->assertSame(false, $this->hero->isMale());
    }

    public function test_isFemale()
    {
        $this->assertSame(true, $this->hero->isFemale());
    }

    public function test_getLevel()
    {
        $this->assertSame(70, $this->hero->getLevel());
    }

    public function test_getParagonLevel()
    {
        $this->assertSame(73, $this->hero->getParagonLevel());
    }

    public function test_isHardcore()
    {
        $this->assertSame(false, $this->hero->isHardcore());
    }

    public function test_getHardcore()
    {
        $this->assertSame(false, $this->hero->getHardcore());
    }

    public function test_isDead()
    {
        $this->assertSame(false, $this->hero->isDead());
    }

    public function test_getDead()
    {
        $this->assertSame(false, $this->hero->getDead());
    }

    public function test_getLastUpdated()
    {
        $this->assertSame(1397149731, $this->hero->getLastUpdated());
    }

    public function test_getEliteKills()
    {
        $this->assertSame(2653, $this->hero->getEliteKills());
    }

    public function test_getStats()
    {
        $this->assertSame($this->stats, $this->hero->getStats());
    }

    public function test_getStat()
    {
        foreach($this->stats as $stat => $val)
        {
            $this->assertSame($val, $this->hero->getStat($stat));
        }
    }

    public function test_getItems()
    {
        $items = $this->hero->getItems();

        $this->assertInternalType('array', $items);

        $this->assertCount(13, $items);

        foreach($items as $item)
        {
            $this->assertInstanceOf('\Diabloheroes\D3api\Item', $item);
        }

//        var_dump($items);
    }


}
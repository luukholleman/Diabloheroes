<?php
/**
 * @author Luuk Holleman
 * @email luukholleman@gmail.com
 */

namespace Diabloheroes\D3api;

use Diabloheroes\D3api\Connector\Career as Connector;

class Career
{
    public $connector;

    private $battletag;

    private $region;

    public $data;

    const BARBARIAN = 'barbarian';
    const CRUSADER = 'crusader';
    const DEMON_HUNTER = 'demon-hunter';
    const MONK = 'monk';
    const WITCH_DOCTOR = 'witch-doctor';
    const WIZARD = 'wizard';

    const ACT1 = 'act1';
    const ACT2 = 'act2';
    const ACT3 = 'act3';
    const ACT4 = 'act4';
    const ACT5 = 'act5';

    const EU = 'eu';
    const US = 'us';
    const KR = 'kr';

    public function __construct($battletag, $region, $initialData = null)
    {
        $this->battletag = str_replace('#', '-', $battletag);
        $this->region = $region;

        if (isset($initialData))
            $this->data = $initialData;

        $this->connector = new Connector();
    }

    public function fetch()
    {
        $this->data = $this->connector->get($this->region, $this->battletag);

        if ($this->data == false)
            return false;

        $this->data = json_decode($this->data, true);

        if(isset($this->data['code']))
            return false;

        return true;
    }

    public function getHeroes($autoFetch = true)
    {
        $heroes = array();

        foreach ($this->data['heroes'] as $hero) {
            $tmpHero = new Hero($this->battletag, $hero['id'], $this->region, $hero);

            $tmpHero->connector->cache = $this->connector->cache;
            $tmpHero->connector->cachingDir = $this->connector->cachingDir;

            if ($autoFetch == true)
                $tmpHero->fetch();

            $heroes[] = $tmpHero;
        }

        return $heroes;
    }

    public function getFallenHeroes($autoFetch = true)
    {
        throw new \Exception("Doesn't work, blizzard does not include this data properly");
//        $heroes = array();
//
//        foreach ($this->data['fallenHeroes'] as $hero) {
//            $tmpHero = new Hero($this->battletag, $hero['id'], $this->region, $hero);
//
//            if ($autoFetch == true)
//                $tmpHero->fetch();
//
//            $heroes[] = $tmpHero;
//        }
//
//        return $heroes;
    }

    public function getLastPlayedHero($autoFetch = true)
    {
        $hero = new Hero($this->battletag, $this->data['lastHeroPlayed'], $this->region);

        $hero->connector->cache = $this->connector->cache;
        $hero->connector->cachingDir = $this->connector->cachingDir;

        if ($autoFetch == true)
            $hero->fetch();

        return $hero;
    }

    public function getLastUpdated()
    {
        return $this->data['lastUpdated'];
    }

    public function getMonstersKilled()
    {
        return $this->data['kills']['monsters'];
    }

    public function getElitesKilled()
    {
        return $this->data['kills']['elites'];
    }

    public function getHardcoreMonstersKilled()
    {
        return $this->data['kills']['hardcoreMonsters'];
    }

    public function getTimePlayed($class = null)
    {
        if(is_null($class))
            return $this->data['timePlayed'];

        return $this->data['timePlayed'][$class];
    }

    public function getParagonLevel()
    {
        return $this->data['paragonLevel'];
    }

    public function getHardcoreParagonLevel()
    {
        return $this->data['paragonLevelHardcore'];
    }

    public function getBattletag()
    {
        return $this->data['battleTag'];
    }

    public function getProgression($act = null)
    {
        if($act == null)
            return $this->data['progression'];

        return $this->data['progression'][$act];
    }
}
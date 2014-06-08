<?php

namespace DH\Import\Command;

use DH\Command\CommandBus;
use DH\Command\CommandHandlerInterface;
use DH\Command\CommandInterface;
use DH\Event\EventDispatcher;
use DH\Event\EventGenerator;
use DH\Import\Event\CareerWasImported;
use DH\Import\Event\CareerWasNotImported;

/**
 * Class ImportCareerCommandHandler
 * @package DH\Import\Command
 */
class ImportCareerCommandHandler implements CommandHandlerInterface
{
    use EventGenerator;

    /**
     * @param ImportCareerCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $battletag = $command->battletag;

        $region = $command->region;

        if (\Config::get('app.debug'))
            \DB::connection()->disableQueryLog();

        $regions = array();

        if ($region != null)
            $regions[] = $region;
        else
            $regions = [
                \Diabloheroes\D3api\Career::EU,
                \Diabloheroes\D3api\Career::US,
                \Diabloheroes\D3api\Career::KR,
            ];

        foreach ($regions as $region)
            $this->importCareer($battletag, $region);

        EventDispatcher::dispatch($this->releaseEvents());
    }

    /**
     * @param $battletag
     * @param $region
     */
    public function importCareer($battletag, $region)
    {
        try {
            $apiCareer = new \Diabloheroes\D3api\Career($battletag, $region);

            $apiCareer->connector->cache = true;
            $apiCareer->connector->cachingDir = app_path() . '/storage/api/';

            if ($apiCareer->fetch()) {
                $career = \Career::firstOrNew(['battletag' => $apiCareer->getBattletag()]);

                $career->save();

                $careerRegion = \Career\Region::firstOrNew([
                    'career_id' => $career->id,
                    'region' => $region
                ]);

                $careerRegion->fill([
                    'monsters_killed' => $apiCareer->getMonstersKilled(),
                    'hardcore_monsters_killed' => $apiCareer->getHardcoreMonstersKilled(),
                    'elites_killed' => $apiCareer->getElitesKilled(),
                    'time_played' => json_encode($apiCareer->getTimePlayed()),
                    'paragon_level' => $apiCareer->getParagonLevel(),
                    'hardcore_paragon_level' => $apiCareer->getHardcoreParagonLevel(),
                    'last_played_hero' => @$apiCareer->getLastPlayedHero(false)->getId(),
                ]);

                $careerRegion->save();

                EventDispatcher::dispatch(new CareerWasImported($region, $career));

                foreach ($apiCareer->getHeroes(false) as $hero) {
                    $existingHero = \Hero::whereBlizzardId($hero->getId())->first();

                    if($existingHero == null || $existingHero->eligibleForUpdate($hero->getLastUpdated()))
                        CommandBus::execute(new ImportHeroCommand($region, $battletag, $careerRegion, $hero->getId()));
                }
            } else {
                EventDispatcher::dispatch(new CareerWasNotImported($region, $battletag));
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
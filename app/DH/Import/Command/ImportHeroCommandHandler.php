<?php
namespace DH\Import\Command;

use DH\Command\CommandBus;
use DH\Command\CommandHandlerInterface;
use DH\Command\CommandInterface;
use DH\Event\EventDispatcher;
use DH\Import\Event\HeroWasImported;
use DH\Import\Event\HeroWasNotImported;

class ImportHeroCommandHandler implements CommandHandlerInterface
{

    /**
     * @param \DH\Import\Command\ImportHeroCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $battletag = $command->battletag;
        $region = $command->region;
        $heroId = $command->heroId;
        $careerRegion = $command->careerRegion;

        try {
            $apiHero = new \Diabloheroes\D3api\Hero($battletag, $heroId, $region);

            $apiHero->connector->cache = true;
            $apiHero->connector->cachingDir = app_path() . '/storage/api/';

            $apiHero->fetch();

            $hero = \Hero::firstOrNew(['blizzard_id' => $apiHero->getId()]);

            if ($careerRegion != null)
                $hero->career_region_id = $careerRegion->id;

            $hero->fill([
                'region' => $region,
                'name' => $apiHero->getName(),
                'gender' => $apiHero->getGender(),
                'klass' => new \Klass($apiHero->getClass()),
                'level' => $apiHero->getLevel(),
                'hardcore' => $apiHero->getHardcore(),
                'dead' => $apiHero->getDead(),
                'last_played' => date('c', $apiHero->getLastUpdated()),
            ]);

            $hero->save();

            foreach ($apiHero->getStats() as $name => $value) {
                $stat = \Stat::firstOrCreate(['name' => $name]);

                $heroStat = \Hero\Stat::firstOrNew([
                    'hero_id' => $hero->id,
                    'stat_id' => $stat->id,
                ]);

                $heroStat->value = $value;

                $heroStat->save();
            }

            $hero->destroySkillActives();

            foreach ($apiHero->getActiveSkills() as $apiSkillActive) {
                $skillActiveCategory = \Skill\Active\Category::firstOrCreate([
                    'name' => $apiSkillActive->getCategorySlug()
                ]);

                $skillActive = \Skill\Active::firstOrNew([
                    'skill_active_category_id' => $skillActiveCategory->id,
                    'slug' => $apiSkillActive->getSlug(),
                ]);

                $skillActive->fill([
                    'name' => $apiSkillActive->getName(),
                    'icon' => $apiSkillActive->getIcon(),
                    'level' => $apiSkillActive->getLevel(),
                    'tooltip_url' => $apiSkillActive->getTooltipUrl(),
                    'description' => $apiSkillActive->getDescription(),
                    'simple_description' => $apiSkillActive->getSimpleDescription(),
                    'skill_calc_id' => $apiSkillActive->getSkillCalcId()
                ]);

                $skillActive->save();

                if ($apiSkillActive->hasRune()) {
                    $apiRune = $apiSkillActive->getRune();

                    $rune = \Rune::firstOrNew([
                        'slug' => $apiRune->getSlug()
                    ]);

                    $rune->fill([
                        'type' => $apiRune->getType(),
                        'name' => $apiRune->getName(),
                        'level' => $apiRune->getLevel(),
                        'tooltip_url' => $apiRune->getTooltipUrl(),
                        'description' => $apiRune->getDescription(),
                        'simple_description' => $apiRune->getSimpleDescription(),
                        'skill_calc_id' => $apiRune->getSkillCalcId(),
                        'order' => $apiRune->getOrder()
                    ]);

                    $rune->save();
                }

                $heroSkillActive = \Hero\Skill\Active::firstOrNew([
                    'skill_active_id' => $skillActive->id,
                    'hero_id' => $hero->id,
                ]);

                if (isset($rune))
                    $heroSkillActive->rune_id = $rune->id;

                $heroSkillActive->save();
            }

            foreach ($apiHero->getPassiveSkills() as $apiSkillPassive) {
                $skillPassive = \Skill\Passive::firstOrNew([
                    'slug' => $apiSkillPassive->getSlug()
                ]);

                $skillPassive->fill([
                    'name' => $apiSkillPassive->getName(),
                    'icon' => $apiSkillPassive->getIcon(),
                    'level' => $apiSkillPassive->getLevel(),
                    'tooltip_url' => $apiSkillPassive->getTooltipUrl(),
                    'description' => $apiSkillPassive->getDescription(),
                    'flavor' => $apiSkillPassive->getFlavor(),
                    'skill_calc_id' => $apiSkillPassive->getSkillCalcId(),
                ]);

                $skillPassive->save();

                $heroSkillPassive = \Hero\Skill\Passive::firstOrNew([
                    'skill_passive_id' => $skillPassive->id,
                    'hero_id' => $hero->id,
                ]);

                $heroSkillPassive->save();
            }

            EventDispatcher::dispatch(new HeroWasImported($region, $battletag, $careerRegion, $hero));

            foreach ($apiHero->getItems(false) as $item) {
                CommandBus::execute(new ImportItemCommand($region, $hero, $item->getSlot(), $item->getTooltipParams()));
            }

        } catch (Exception $e) {
            EventDispatcher::dispatch(new HeroWasNotImported($region, $battletag, $careerRegion, $heroId));
        }
    }
}
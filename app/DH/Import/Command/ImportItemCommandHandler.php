<?php
namespace DH\Import\Command;

use DH\Command\CommandHandlerInterface;
use DH\Command\CommandInterface;
use DH\Event\EventDispatcher;
use DH\Import\Event\ItemWasImported;
use DH\Import\Event\ItemWasNotImported;

/**
 * Class ImportItemCommandHandler
 * @package DH\Import\Command
 */
class ImportItemCommandHandler implements CommandHandlerInterface
{

     /**
     * @param \DH\Import\Command\ImportItemCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $tooltipParams = $command->tooltipParams;

        $region = $command->region;

        $hero = $command->hero;

        $slot = $command->slot;

        try{
            $apiItem = new \Diabloheroes\D3api\Item($tooltipParams, $region);

            $apiItem->connector->cache = true;
            $apiItem->connector->cachingDir = app_path() . '/storage/api/';

            $apiItem->fetch();

            $item = \Item::firstOrNew(['tooltip_params' => $tooltipParams]);

            if ($hero->id != null)
                $item->hero_id = $hero->id;

            $item->fill([
                'name' => $apiItem->getName(),
                'slot' => $slot,
                'icon' => $apiItem->getIcon(),
                'required_level' => $apiItem->getRequiredLevel(),
                'item_level' => $apiItem->getItemLevel(),
                'bonus_affixes' => $apiItem->getBonusAffixes(),
                'bonus_affixes_max' => $apiItem->getBonusAffixesMax(),
                'account_bound' => $apiItem->getAccountBound(),
                'type_name' => $apiItem->getTypeName(),
                'two_handed' => $apiItem->getTwoHanded(),
                'type_id' => $apiItem->getTypeId(),
                'armor' => $apiItem->getArmorMin(),
                'armor_max' => $apiItem->getArmorMax(),
            ]);

            $item->save();

            foreach ($apiItem->getRawAttributes() as $attributeKey => $value) {
                $itemAttribute = \Item\Attribute::firstOrNew(['name' => $attributeKey]);

                $itemAttribute->save();

                $itemAttributeRaw = \Item\Attribute\Raw::firstOrNew([
                    'item_id' => $item->id,
                    'item_attribute_id' => $itemAttribute->id
                ]);

                $itemAttributeRaw->min = $value['min'];
                $itemAttributeRaw->max = $value['max'];

                $itemAttributeRaw->save();
            }

            foreach($apiItem->getGems() as $apiGem)
            {
                $gem = \Gem::firstOrNew([
                    'blizzard_id' => $apiGem->getId()
                ]);

                $gem->fill([
                    'name' => $apiGem->getName(),
                    'icon' => $apiGem->getIcon(),
                    'display_color' => $apiGem->getDisplayColor(),
                    'tooltip_params' => $apiGem->getTooltipParams(),
                ]);

                $gem->save();

                $itemGem = \Item\Gem::firstOrNew([
                    'item_id' => $item->id,
                    'gem_id' => $gem->id,
                ]);

                $itemGem->slot = $apiGem->getSlot();

                $itemGem->save();
            }

            EventDispatcher::dispatch(new ItemWasImported($region, $item));
        }
        catch(Exception $e)
        {
            EventDispatcher::dispatch(new ItemWasNotImported($region, $tooltipParams));
        }
    }
}
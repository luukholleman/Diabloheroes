<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportItem extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'item:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
	    try{
	        $apiItem = new \Diabloheroes\D3api\Item($this->argument('item'), $this->argument('region'));

	        $apiItem->connector->cache = true;
	        $apiItem->connector->cachingDir = app_path().'/storage/api/';

	        $apiItem->fetch();

	        $item = Item::firstOrNew(['tooltip_params' => $this->argument('item')]);

	        if ($this->option('hero') != null)
	            $item->hero_id = $this->option('hero');

	        $item->fill([
	            'name' => $apiItem->getName(),
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
	            $itemAttribute = Item\Attribute::firstOrNew(['name' => $attributeKey]);

	            $itemAttribute->save();

	            $itemAttributeRaw = Item\Attribute\Raw::firstOrNew([
	                'item_id' => $item->id,
	                'item_attribute_id' => $itemAttribute->id
	            ]);

	            $itemAttributeRaw->min = $value['min'];
	            $itemAttributeRaw->max = $value['max'];

	            $itemAttributeRaw->save();
	        }

	        foreach($apiItem->getGems() as $apiGem)
	        {
	            $gem = Gem::firstOrNew([
	                'blizzard_id' => $apiGem->getId()
	            ]);

	            $gem->fill([
	                'name' => $apiGem->getName(),
	                'icon' => $apiGem->getIcon(),
	                'display_color' => $apiGem->getDisplayColor(),
	                'tooltip_params' => $apiGem->getTooltipParams(),
	            ]);

	            $gem->save();

	            $itemGem = Item\Gem::firstOrNew([
	                'item_id' => $item->id,
	                'gem_id' => $gem->id,
	            ]);

	            $itemGem->slot = $apiGem->getSlot();

	            $itemGem->save();
	        }

	        echo sprintf("\t\tItem %s imported\n", $apiItem->getName());
	    }
	    catch(Exception $e)
	    {
		    echo $e->getMessage();
	    }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('item', InputArgument::REQUIRED, 'Item tooltip params'),
            array('region', InputArgument::REQUIRED, 'Region'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('hero', null, InputOption::VALUE_OPTIONAL, 'Hero to reference to', null),
        );
    }

}
